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
            // Remove duplicate foreign key definitions
            $table->dropForeign(['invoice_id']);
            $table->foreignIdFor(App\Models\Invoice::class)->constrained()->onDelete('cascade');

            // Make customer_address and customer_phone nullable
            $table->string('customer_address')->nullable()->change();
            $table->string('customer_phone')->nullable()->change();

            // Ensure consistency in foreign key definitions
            $table->dropForeign(['company_id']);
            $table->foreignIdFor(App\Models\Company::class)->constrained()->onDelete('cascade');
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

            // Revert foreign key definitions
            $table->dropForeign(['invoice_id']);
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');

            $table->dropForeign(['company_id']);
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }
};
