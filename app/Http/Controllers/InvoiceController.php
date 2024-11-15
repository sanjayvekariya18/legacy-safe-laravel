<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\User;
use App\Services\BreadcrumbsService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    use AuthorizesRequests;
    protected $breadcrumbs;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
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

        $invoices = Invoice::where('name', 'like', "%{$search}%")->paginate(10); // Paginate the results

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

        DB::beginTransaction();
        Invoice::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        DB::commit();
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');

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

    public function pay(Invoice $invoice)
    {
        // Only Professional can pay invoices
        $this->authorize('pay', $invoice);
    }
}
