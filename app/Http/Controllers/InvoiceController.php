<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\User;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class InvoiceController extends Controller
{
    use AuthorizesRequests;
    protected $breadcrumbs;
    protected $stripe;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        // Initialize the StripeClient with your secret key
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Both Admin and Professional can view invoices
        $this->authorize('viewAny', Invoice::class);
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Invoices', route('invoices.index'));

        // Get the search query from the request
        $search = $request->input('search');

        $invoices = Invoice::where('name', 'like', "%{$search}%")->paginate(50); // Paginate the results

        return view('invoices.index', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'invoices' => $invoices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only Admin can create invoices
        $this->authorize('create', Invoice::class);
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Invoices', route('invoices.index'));
        $this->breadcrumbs->add('create', '#');

        $professionalUsers = User::role(User::ROLE_PROFESSIONAL)->get();

        return view('invoices.create', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'professionalUsers' => $professionalUsers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        // Only Admin can create invoices
        $this->authorize('create', Invoice::class);
        try {
            // Create the Stripe customer
            $professional = User::find($request->user_id);
            $professional->createOrGetStripeCustomer();

            $invoice = $this->stripe->invoices->create([
                'customer' => $professional->stripe_id, // Make sure the Professional is connected to Stripe
                'currency' => config('cashier.currency'),
                'collection_method' => 'send_invoice',     // Manually send invoice
                'days_until_due' => 30,
            ]);

            // Create an invoice item on Stripe
            $this->stripe->invoiceItems->create([
                'invoice' => $invoice->id,
                'customer' => $professional->stripe_id, // Make sure the Professional is connected to Stripe
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => config('cashier.currency'),
                'description' => $request->description,
            ]);
            // Finalize the invoice to apply all invoice items
            $invoice->finalizeInvoice();

            Invoice::create([
                'user_id' => $request->user_id,
                'invoice_id' => $invoice->id,
                'name' => $request->name,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);
            return redirect()->route('invoices.index')->with('success', "Invoice created.");
        } catch (\Throwable $th) {
            return redirect()->route('invoices.index')->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // Both Admin and Professional can view a specific invoice
        $this->authorize('view', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        // Only Admin can edit invoices
        $this->authorize('update', $invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // Only Admin can edit invoices
        $this->authorize('update', $invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        // Only Admin can delete invoices
        $this->authorize('delete', $invoice);
    }

    /**
     * Display a listing of the resource.
     */
    public function getCard(Request $request, Invoice $invoice)
    {
        // Only Professional can access this card
        $this->authorize('card', $invoice);

        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Invoices', route('invoices.index'));

        // Create a payment method intent
        $intent = Auth::user()->createSetupIntent();

        return view('invoices.card', [
            'stripePublicKey' => config('cashier.key'),
            'clientSecret' => $intent->client_secret,
            'invoice' => $invoice,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    public function pay(Request $request, Invoice $invoice)
    {
        // Only Professional can pay invoice
        $this->authorize('pay', $invoice);
        try {
            // Retrieve the invoice from Stripe using the $this->stripe object
            $stripeInvoice = $this->stripe->invoices->retrieve($invoice->invoice_id);;

            // If the invoice is not paid yet, attempt to pay it
            if ($stripeInvoice->status !== 'paid') {
                // You can use the default payment method for this user to pay the invoice
                $stripeInvoice->pay(
                    [
                        'payment_method' => $request->payment_method_id,
                    ]
                );
                $invoice->update(['status' => INVOICE::STATUS_COMPLETED]);
                return redirect()->route('invoices.index')->with('success', "Invoice paid successfully!");
            } else {
                return redirect()->route('invoices.index')->with('error', "Invoice already paid!");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating invoice: ' . $th->getMessage());
        }
    }

    public function downloadInvoice(Invoice $invoice)
    {
        // Only Professional can download invoice
        $this->authorize('downloadInvoice', $invoice);
        try {
            $stripeInvoice = $this->stripe->invoices->retrieve($invoice->invoice_id);
            // Redirect the user to the PDF URL
            return response()->redirectTo($stripeInvoice->invoice_pdf);
        } catch (\Exception $e) {
            // Handle the error (e.g., invalid invoice ID)
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
