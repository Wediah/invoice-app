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
        // Add country code to users table (production-safe)
        if (!Schema::hasColumn('users', 'country_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('country_code', 5)->default('GH')->after('phone_number');
            });
        }

        // Add country codes to companies table (production-safe)
        if (!Schema::hasColumn('companies', 'country_code')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('country_code', 5)->default('GH')->after('phone');
            });
        }
        
        if (!Schema::hasColumn('companies', 'phone2_country_code')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('phone2_country_code', 5)->nullable()->after('phone2');
            });
        }
        
        if (!Schema::hasColumn('companies', 'phone3_country_code')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('phone3_country_code', 5)->nullable()->after('phone3');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['country_code', 'phone2_country_code', 'phone3_country_code']);
        });
    }
};