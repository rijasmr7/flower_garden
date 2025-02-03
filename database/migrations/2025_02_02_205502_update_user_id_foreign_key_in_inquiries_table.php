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
        Schema::table('inquiries', function (Blueprint $table) {
            // Drop the old foreign key
            $table->dropForeign('inquiries_customer_id_foreign'); 

            // Add the new foreign key referencing the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            // Drop the foreign key if rolling back
            $table->dropForeign(['user_id']);

            // Revert the foreign key back to customers (if needed)
            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }
};

