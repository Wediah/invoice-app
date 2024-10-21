<?php

use App\invoiceStatus;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            $table->date('due_date');
            $table->string('salesperson')->nullable();
            $table->text('notes')->nullable();
            $table->string('balance')->nullable();
            $table->string('status')->default(invoiceStatus::UNPAID->value);


            // Fields for storing computed values
            $table->decimal('subtotal', 15, 2)->nullable();
            $table->decimal('discount_total', 15, 2)->nullable();
            $table->decimal('primary_tax_total', 15, 2)->nullable();
            $table->decimal('secondary_tax_total', 15, 2)->nullable();
            $table->decimal('tax_total', 15, 2)->nullable();
            $table->decimal('final_total', 15, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
