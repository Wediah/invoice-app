<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('invoice_prefix')->default('APINV')->nullable()->change();
        });

        // Update existing records with NULL invoice_prefix to the default value
        DB::table('companies')->whereNull('invoice_prefix')->update(['invoice_prefix' => 'APINV']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('invoice_prefix')->nullable()->change();
        });
    }
};
