<?php

use App\Models\invoice;
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
        schema::create("invoice_customer_info", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(invoice::class);
            $table->string("customer_name");
            $table->string("customer_email");
            $table->string("customer_address");
            $table->string("customer_mobile");
            $table->string("customer_phone");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists("invoice_customer_info");
    }
};
