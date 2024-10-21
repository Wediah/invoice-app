<?php

use App\companyStatus;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('address')->nullable();
            $table->string('gps_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('company_category_id')->nullable()->constrained('company_categories')->onDelete('set null');
            $table->string('email')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('currency', 255)->default('GH₵')->nullable(true);
            $table->string('tax_identification_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->string('invoice_numbering')->default(0)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('merchant_network')->nullable();
            $table->string('merchant_number')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('status')->default(companyStatus::PENDING->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
