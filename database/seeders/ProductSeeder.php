<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Stripe\Stripe;
use Stripe\Product as StripeProduct;
use Stripe\Price as StripePrice;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Set your Stripe secret key
        Stripe::setApiKey(config('cashier.secret'));

        $names = ["Standard","Professional","Enterprise"];
        $monthlyPrices = [99,199,299];
        $yearlyPrices = [79,179,279];

        // Create 3 fake products
        $faker = Faker::create();
        for ($i = 0; $i < 3; $i++) {
            $title = $faker->sentence;
            $description = $faker->sentence;

            // Create the product on Stripe
            $stripeProduct = StripeProduct::create([
                'name' => $names[$i],
                'description' => $description,
            ]);

            // Create monthly price
            $stripePriceMonthly = StripePrice::create([
                'unit_amount' => $monthlyPrices[$i], // Random price in cents
                'currency' => config('cashier.currency'),
                'product' => $stripeProduct->id,
                'recurring' => ['interval' => 'month'],
            ]);

            // Create yearly price
            $stripePriceYearly = StripePrice::create([
                'unit_amount' => $yearlyPrices[$i], // Random price in cents
                'currency' => config('cashier.currency'),
                'product' => $stripeProduct->id,
                'recurring' => ['interval' => 'year'],
            ]);

            // Store the product in the local database
            Product::create([
                'name' => $names[$i],
                'title' => $title,
                'description' => $description,
                'monthly_price' => $monthlyPrices[$i],
                'yearly_price' => $yearlyPrices[$i],
                'stripe_product_id' => $stripeProduct->id,
                'stripe_price_id_monthly' => $stripePriceMonthly->id,
                'stripe_price_id_yearly' => $stripePriceYearly->id,
            ]);
        }
    }
}
