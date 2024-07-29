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
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('bank_details', 'account_number');
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('merchant_network')->nullable();
            $table->string('merchant_number')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
