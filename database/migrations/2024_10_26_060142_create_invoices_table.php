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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->string('invoice_id'); // Invoice ID from payment gateway
            $table->string('name'); // Name associated with the invoice
            $table->decimal('amount', 10, 2); // Amount of the invoice
            $table->text('description')->nullable(); // Description of the invoice
            $table->enum('status', ['pending', 'paid', 'canceled', 'refunded']); // Status of the invoice
            $table->timestamp('deleted_at')->nullable(); // Soft delete column
            $table->timestamp('created_at')->useCurrent(); // Created at column
            $table->timestamp('updated_at')->useCurrent(); // Updated at column

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Cascade on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
