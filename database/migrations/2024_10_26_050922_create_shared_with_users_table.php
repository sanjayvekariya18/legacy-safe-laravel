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
        Schema::create('shared_with_users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->unsignedBigInteger('document_id'); // Foreign key for document
            $table->boolean('to_be_notified')->default(false); // Notification preference
            $table->boolean('to_be_visible')->default(true); // Visibility preference
            $table->boolean('mark_as_seen')->default(false); // Mark as Seen preference
            $table->timestamp('deleted_at')->nullable(); // Soft delete column
            $table->timestamp('created_at')->useCurrent(); // Created at column
            $table->timestamp('updated_at')->useCurrent(); // Updated at column

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Cascade on delete
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade'); // Cascade on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_with_users');
    }
};
