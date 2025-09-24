<?php

use App\Models\Invoice;
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
            $table->foreignIdFor(Invoice::class);
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string("customer_name");
            $table->string("customer_email")->nullable();
            $table->string("customer_address");
            $table->string("customer_mobile")->nullable();
            $table->string("customer_phone");

            $table->timestamps();
            $table->softDeletes();


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