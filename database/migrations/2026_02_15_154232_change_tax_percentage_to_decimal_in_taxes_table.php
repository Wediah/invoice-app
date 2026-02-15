<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Changes tax_percentage from integer to decimal(5,2) so values like 2.5 and 2.23 are preserved.
     * Existing integer values (e.g. 5, 10) are preserved as 5.00, 10.00 — no data loss.
     */
    public function up(): void
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->decimal('tax_percentage', 5, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     * WARNING: Reverting will truncate decimal values (e.g. 2.50 becomes 2). Only use before storing decimals.
     */
    public function down(): void
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->integer('tax_percentage')->change();
        });
    }
};
