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
        Schema::table('invoice_customer_info', function (Blueprint $table) {
            // Make customer_address and customer_phone nullable
            $table->string('customer_address')->nullable()->change();
            $table->string('customer_phone')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_customer_info', function (Blueprint $table) {
            // Revert customer_address and customer_phone to not nullable
            $table->string('customer_address')->nullable(false)->change();
            $table->string('customer_phone')->nullable(false)->change();
        });
    }
};
