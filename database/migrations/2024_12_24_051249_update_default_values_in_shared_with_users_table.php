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
        Schema::table('shared_with_users', function (Blueprint $table) {
            $table->boolean('to_be_notified')->default(0)->change();
            $table->boolean('to_be_visible')->default(0)->change();
            $table->boolean('mark_as_seen')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shared_with_users', function (Blueprint $table) {
            $table->boolean('to_be_notified')->default(1)->change();
            $table->boolean('to_be_visible')->default(1)->change();
            $table->boolean('mark_as_seen')->default(1)->change();
        });
    }
};
