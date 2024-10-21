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
        // Create the taxes table
        Schema::create('taxes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('tax_name'); // Name of the tax
            $table->string('type');
            $table->integer('tax_percentage'); // Tax percentage
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade'); // Cascade delete when the company is deleted
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes();

        });
    }

    public function down(): void
    {
        // Drop the foreign key and then the taxes table
        Schema::dropIfExists('taxes');
    }
};
