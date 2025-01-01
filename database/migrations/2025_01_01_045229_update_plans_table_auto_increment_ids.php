<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            if (!Schema::hasColumn('plans', 'product_id')) {
                $table->unsignedInteger('product_id')->unique()->autoIncrement();
            }

            if (!Schema::hasColumn('plans', 'monthly_price_id')) {
                $table->unsignedInteger('monthly_price_id')->nullable()->unique();
            }

            if (!Schema::hasColumn('plans', 'yearly_price_id')) {
                $table->unsignedInteger('yearly_price_id')->nullable()->unique();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('monthly_price_id');
            $table->dropColumn('yearly_price_id');
        });
    }
};
