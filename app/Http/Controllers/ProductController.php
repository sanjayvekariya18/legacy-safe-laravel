<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\StripeClient;

class ProductController extends Controller
{
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
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Products', route('products.index'));

        $products = Product::all(); // Get all products from the database
        return view('products.index', [
            'products' => $products,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Products', route('products.index'));

        return view('products.create', [
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            // Create product on Stripe
            $stripeProduct = $this->stripe->products->create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $stripePriceMonthly = $this->createProductPrice($stripeProduct->id,$request->monthly_price, "month");
            $stripePriceYearly = $this->createProductPrice($stripeProduct->id,$request->yearly_price, "year");


            // Store product information in the local database
            Product::create([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'monthly_price' => $request->monthly_price,
                'yearly_price' => $request->yearly_price,
                'stripe_product_id' => $stripeProduct->id,
                'stripe_price_id_monthly' => $stripePriceMonthly->id,
                'stripe_price_id_yearly' => $stripePriceYearly->id,
            ]);
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Products', route('products.index'));
        $this->breadcrumbs->add($product->name, route('products.edit', $product));

        return view('products.edit', [
            'product' => $product,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {

            // Update the product on Stripe
            $stripeProduct = $this->stripe->products->update(
                $product->stripe_product_id,
                [
                    'name' => $request->name,
                    'description' => $request->description,
                ]
            );

            $stripePriceMonthly = $this->createProductPrice($product->stripe_product_id,$request->monthly_price, "month");
            $stripePriceYearly = $this->createProductPrice($product->stripe_product_id,$request->yearly_price, "year");

            $this->deactivateProductPrices($product);

            // Update the product information in the local database
            $product->update([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'monthly_price' => $request->monthly_price,
                'yearly_price' => $request->yearly_price,
                'stripe_product_id' => $stripeProduct->id,
                'stripe_price_id_monthly' => $stripePriceMonthly->id,
                'stripe_price_id_yearly' => $stripePriceYearly->id,
            ]);

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $this->deactivateProductPrices($product);
            $this->stripe->products->update($product->stripe_product_id, ['active' => false]);
            $product->delete();
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product and price deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', $th->getMessage());
        }
    }

    function deactivateProductPrices($product) {
        // Deactivate the price
        $this->stripe->prices->update($product->stripe_price_id_monthly, ['active' => false]);
        $this->stripe->prices->update($product->stripe_price_id_yearly, ['active' => false]);
    }

    function createProductPrice($productId, $price, $interval) {
        // Create Product price
       return $this->stripe->prices->create([
            'unit_amount' => $price * 100,
            'currency' => config('cashier.currency'),
            'product' => $productId,
            'recurring' => ['interval' => $interval],
        ]);
    }
}
