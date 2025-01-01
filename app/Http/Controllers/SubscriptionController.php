<?php

namespace App\Http\Controllers;

use App\Helper\StripeHelper;
use App\Http\Requests\PlanCreateRequest;
use App\Http\Requests\StripeSubscriptionRequest;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use App\Repositories\SubscriptionRepository;
use Exception;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{

    public function __construct(private SubscriptionRepository $SubscriptionRepository, private MessageController $messageController)
    {
    }

    public function index()
    {
        $allPlane = Plan::all();
        return view('document.upgrade_plan', compact('allPlane'));
    }

    public function show($id)
    {
        $plans = Plan::findOrFail($id);
        $monthlyPrice = $plans->monthly_price;
        $yearlyPrice = $plans->yearly_price;
        return view('document.pay_subscription', compact('plans', 'monthlyPrice', 'yearlyPrice'));
    }

    public function pay(StripeSubscriptionRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => bcrypt($request->password),
            ]);

            $planId = $request->plan_id;
            $stripeToken = $request->stripe_token;

            $planDetails = UserPlan::findOrFail($planId);
            $stripePlanId = $planDetails->plan_id;

            $stripeUser = $user->stripeUser;

            if (!$stripeUser) {

                $clientObject = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'source' => $stripeToken,
                ];

                $customerRes = StripeHelper::createCustomer($clientObject, $stripeToken);
                if (!$customerRes['status']) {
                    return response()->json(['status' => false, 'message' => $customerRes['error']]);
                }
                $customerId = $customerRes['data']->id;

                $stripeUser = UserPlan::create([
                    'user_id' => $user->id,
                    'plan_id' => $customerId,
                ]);
            } else {
                $customerId = $stripeUser->plan_id;
            }

            $subscriptionResult = StripeHelper::createSubscription($customerId, $stripePlanId);
            if (!$subscriptionResult['status']) {
                return response()->json(['status' => false, 'message' => $subscriptionResult['error']]);
            }

            UserPlan::create([
                'id' => $user->id,
                'user_id' => $stripeUser->id,
                'subscription_id' => $subscriptionResult['data']->id,
                'plan_id' => $planDetails->id,
                'payment_type' => 'stripe',
            ]);

            DB::commit();

            return response()->json(['status' => true, 'message' => 'Your subscription created successfully']);
        } catch (Exception $e) {

            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function userSubscription($data, $request = null)
    {
        $subscriptionResult = $data;
        $createSubscrArray = array(
            'plan_id' => $request->plan_id,
            'subscription_id' => $subscriptionResult['data']->id,
            'user_id' => $request->user_id,
        );
        UserPlan::create($createSubscrArray);
    }

    public function store(PlanCreateRequest $request)
    {
        try {

            $stripe = new StripeClient('sk_test_51QDJA9IIWAdubTmIM1KNYh2mxDhwIjEJoVU2FLrvz4yjpUkezFQvgXSOjWBhOSFeyBIdjeNmkP3De5GVNOEInYGv00Ijs4pRlt');

            $stripePlan = $stripe->plans->create([
                'name' => $request->name,
                'title' => $request->title,
                'monthly_price' => $request->monthly_price * 100,
                'yearly_price' => $request->yearly_price * 100,
                'description' => $request->description,
                'currency' => $request->currency,
                'product_id' => $request->product_id,
                'monthly_price_id' => $request->monthly_price_id,
                'yearly_price_id' => $request->yearly_price_id,
            ]);
            dd($stripe);

            if ($stripePlan) {
                Plan::create([
                    'name' => $request->name,
                    'title' => $request->title,
                    'monthly_price' => $request->monthly_price * 100,
                    'yearly_price' => $request->yearly_price * 100,
                    'description' => $request->description,
                    'currency' => $request->currency,
                    'product_id' => $request->product_id,
                    'monthly_price_id' => $request->monthly_price_id,
                    'yearly_price_id' => $request->yearly_price_id,
                    'stripe_plan_id' => $stripePlan->id,
                ]);

                return redirect()->back()->with('success', 'Plan created successfully!');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
