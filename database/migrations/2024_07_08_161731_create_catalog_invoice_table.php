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
        // Create the catalog_invoice table
        Schema::create('catalog_invoice', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('invoice_id') // Foreign key to the invoices table
                ->constrained()
                ->onDelete('cascade'); // Cascade delete when the invoice is deleted
            $table->foreignId('catalog_id') // Foreign key to the catalogs table
                ->constrained()
                ->onDelete('cascade'); // Cascade delete when the catalog is deleted
            $table->integer('quantity'); // Quantity of items
            $table->decimal('total', 15, 2)->nullable();
            $table->decimal('discount_percent', 8, 2)->nullable(); // Discount field (nullable)
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes();

        });
    }
    
    public function down(): void
    {
        // Drop the catalog_invoice table
        Schema::dropIfExists('catalog_invoice');
    }
};
