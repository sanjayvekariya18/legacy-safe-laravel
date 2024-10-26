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
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->unsignedBigInteger('plan_id')->nullable(); // Foreign key for plan
            $table->string('subscription_id'); // Subscription ID (e.g., from payment gateway)
            $table->boolean('status')->default(true); // Active status of the subscription
            $table->timestamp('deleted_at')->nullable(); // Soft delete column
            $table->timestamp('created_at')->useCurrent(); // Created at column
            $table->timestamp('updated_at')->useCurrent(); // Updated at column

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Cascade on delete
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null'); // Cascade on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_plans');
    }
};
