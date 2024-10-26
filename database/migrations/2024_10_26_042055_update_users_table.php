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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name'); // Remove the name column
            $table->dropTimestamps(); // Remove default timestamps

            // Add new columns if not already added
            $table->unsignedBigInteger('invited_by')->nullable()->after('id');
            $table->string('first_name')->nullable()->after('invited_by');
            $table->string('last_name')->nullable()->after('first_name');
            $table->boolean('status')->default(true)->after('password');
            $table->string('postcode')->nullable()->after('password');
            $table->string('country')->nullable()->after('password');
            $table->string('address2')->nullable()->after('password');
            $table->string('address1')->nullable()->after('password');
            $table->string('professional_type')->nullable()->after('password');
            $table->string('mobile_number')->nullable()->after('password');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Set up the foreign key constraint
            $table->foreign('invited_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(); // Add the name column back if the migration is rolled back
            $table->timestamps(); // Add default timestamps back if the migration is rolled back

            // Drop the foreign key constraint before dropping the invited_by column
            $table->dropForeign(['invited_by']);

            // Remove the new columns added in the up() method
            $table->dropColumn([
                'invited_by', 'first_name', 'last_name', 'mobile_number',
                'professional_type', 'status', 'address1',
                'address2', 'country', 'postcode'
            ]);

            // Remove custom timestamp columns
            $table->dropColumn(['deleted_at', 'created_at', 'updated_at']);
        });
    }
};
