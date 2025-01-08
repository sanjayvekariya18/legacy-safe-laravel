<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Product;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends Controller
{
    protected $breadcrumbs;
    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }


    public function chooseYourPlan(Request $request)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Upgrade your plan', route('subscriptions.index'));

        $user = Auth::user();
        $products = Product::all(); // Get all products from the database
        $subscriptionItem = false;

        if ($user->subscribed('default')) {
            $subscriptionItem = $user->subscription('default')->items->first();
        }

        return view('subscription.index', [
            'products' => $products,
            'subscriptionItem' => $subscriptionItem,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function getCard(SubscriptionRequest $request, Product $product)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Upgrade your plan', route('subscriptions.index'));
        $this->breadcrumbs->add('Select this paln', '#');

        $user = Auth::user();

        // Create a payment method intent
        $intent = $user->createSetupIntent();

        return view('subscription.card', [
            'stripePublicKey' => config('cashier.key'),
            'product' => $product,
            'interval' => $request->interval,
            'clientSecret' => $intent->client_secret,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }



    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            // Check if the user has an active subscription
            $subscription = $user->subscription('default');
            switch ($request->interval) {
                case 'monthly':
                    $priceId = $product->stripe_price_id_monthly;
                    break;
                case 'yearly':
                    $priceId = $product->stripe_price_id_yearly;
                    break;
            }
            if (!$subscription || !$subscription->active()) {

                $user->newSubscription('default', $priceId)  // Replace 'price_id' with your actual Stripe price ID
                    ->create($request->payment_method_id, [
                        'name' => $user->name,
                        'email' => $user->email
                    ]);
            } else {
                $user->updateDefaultPaymentMethod($request->payment_method_id);
                $subscription->swap($priceId);
            }
            DB::commit();
            // Redirect to success page or dashboard
            return redirect()->route('dashboard')->with('success', 'Subscription successful!');

        } catch (IncompletePayment $exception) {
            DB::rollBack();
            // Handle incomplete payment (if user didn't complete the payment)
            return back()->with('error', 'Please complete your payment.');
        }
    }

}
