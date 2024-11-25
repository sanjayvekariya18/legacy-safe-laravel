<?php

use App\Models\User;
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
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inviteer_id'); // The ID of the user who invited
            $table->string('email'); // The email of the invited user
            $table->string('token')->unique(); // Unique token for the invite
            $table->string('professional_type')->nullable(); // Nullable professional type
            $table->enum('role', [User::ROLE_CLIENT, User::ROLE_PROFESSIONAL]); // Role of the invited user
            $table->timestamps();

            // Add foreign key constraint for inviteer_id
            $table->foreign('inviteer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation');
    }
};
