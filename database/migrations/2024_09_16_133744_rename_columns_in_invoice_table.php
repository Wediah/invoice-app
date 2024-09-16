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
        Schema::table('invoices', function (Blueprint $table) {
            $table->renameColumn('email', 'customer_email');
            $table->renameColumn('phone', 'customer_phone');
            $table->renameColumn('address', 'customer_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->renameColumn('customer_email', 'email');
            $table->renameColumn('customer_phone', 'phone');
            $table->renameColumn('customer_address', 'address');
        });
    }
};
