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
        Schema::create('user_invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inviteer_id'); // ID of the user who sent the invitation
            $table->unsignedBigInteger('invitee_id')->nullable(); // ID of the user being invited
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('inviteer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('invitee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_invites');
    }
};
