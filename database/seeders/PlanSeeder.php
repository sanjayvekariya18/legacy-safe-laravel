<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            ['id' => 1, 'name' => 'legacySafe', 'title' => 'legacySafe', 'monthly_price' => 99.00, 'yearly_price' =>0, 'description' => 'legacySafe Plan monthly price 99.00 this currency INR (Indian Rupies ₹) this is more flexibility and golden opportunity', 'currency' => 'INR', 'product_id' => 'price_1QaZanIIWAdubTmIOasqlDgg', 'monthly_price_id' => '1', 'yearly_price_id' => null, 'is_active' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],

            ['id' => 2, 'name' => 'legacySafe', 'title' => 'legacySafe', 'monthly_price' =>0, 'yearly_price' => 699.00, 'description' => 'legacySafe Plan yearly price 699.00 this currency INR (Indian Rupies ₹) this is more flexibility and golden opportunity', 'currency' => 'INR', 'product_id' => 'price_1QaZivIIWAdubTmIP8JBpu5W', 'monthly_price_id' => null, 'yearly_price_id' => '1', 'is_active' => 1, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
