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
        Schema::create('plans', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Name of the plan
            $table->string('title'); // Title of the plan
            $table->decimal('monthly_price', 10, 2); // Monthly price
            $table->decimal('yearly_price', 10, 2); // Yearly price
            $table->text('description')->nullable(); // Description of the plan
            $table->string('currency', 3); // Currency code (e.g., USD)
            $table->string('product_id'); // Foreign key for product
            $table->string('monthly_price_id')->nullable(); // Foreign key for monthly price
            $table->string('yearly_price_id')->nullable(); // Foreign key for yearly price
            $table->boolean('is_active')->default(true); // Active status of the plan
            $table->timestamp('deleted_at')->nullable(); // Soft delete column
            $table->timestamp('created_at')->useCurrent(); // Created at column
            $table->timestamp('updated_at')->useCurrent(); // Updated at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
