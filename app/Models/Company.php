<?php

namespace App\Models;

use App\Models\Tax;
use App\Models\Invoice;
use App\Models\CompanyCategory;
use App\Services\ProfileCompletionService;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, Sluggable, softDeletes;
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    public function catalogs(): HasMany
    {
        return $this->hasMany(Catalog::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(Tax::class);
    }

    public function paymentTerms(): HasMany
    {
        return $this->hasMany(PaymentTerms::class);
    }



    public function customerInfo(): HasMany
    {
        return $this->hasMany(CustomerInfo::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }

    /**
     * Get profile completion data
     */
    public function getProfileCompletionData()
    {
        $service = new ProfileCompletionService($this);
        return $service->getProfileCompletionData();
    }

    /**
     * Get basic information completion
     */
    public function getBasicInfoCompletion()
    {
        $service = new ProfileCompletionService($this);
        return $service->getProfileCompletionData()['basic_info'];
    }

    /**
     * Get advanced information completion
     */
    public function getAdvancedInfoCompletion()
    {
        $service = new ProfileCompletionService($this);
        return $service->getProfileCompletionData()['advanced_info'];
    }

    /**
     * Get financial information completion
     */
    public function getFinancialInfoCompletion()
    {
        $service = new ProfileCompletionService($this);
        return $service->getProfileCompletionData()['financial_info'];
    }

    /**
     * Get settings and preferences completion
     */
    public function getSettingsPreferencesCompletion()
    {
        $service = new ProfileCompletionService($this);
        return $service->getProfileCompletionData()['settings_preferences'];
    }

    /**
     * Get overall completion percentage
     */
    public function getOverallCompletion()
    {
        $service = new ProfileCompletionService($this);
        return $service->getProfileCompletionData()['overall'];
    }

    /**
     * Get formatted phone number with country code
     */
    public function getFormattedPhoneAttribute()
    {
        if (!$this->phone) {
            return null;
        }

        // Handle existing data gracefully - if country_code doesn't exist, assume Ghana
        $countryCode = $this->country_code ?? 'GH';
        
        // For backward compatibility, if country_code is a phone code (like +233), convert to country code
        if (str_starts_with($countryCode, '+')) {
            $countryCode = 'GH'; // Default to Ghana for existing data
        }
        
        $countries = \App\Services\CountryCodeService::getAllCountries();
        $code = $countries[$countryCode]['code'] ?? '+233';
        
        return $code . ' ' . $this->phone;
    }

    /**
     * Get formatted phone2 with country code
     */
    public function getFormattedPhone2Attribute()
    {
        if (!$this->phone2) {
            return null;
        }

        // Handle existing data gracefully
        $countryCode = $this->phone2_country_code ?? 'GH';
        
        // For backward compatibility
        if (str_starts_with($countryCode, '+')) {
            $countryCode = 'GH';
        }
        
        $countries = \App\Services\CountryCodeService::getAllCountries();
        $code = $countries[$countryCode]['code'] ?? '+233';
        
        return $code . ' ' . $this->phone2;
    }

    /**
     * Get formatted phone3 with country code
     */
    public function getFormattedPhone3Attribute()
    {
        if (!$this->phone3) {
            return null;
        }

        // Handle existing data gracefully
        $countryCode = $this->phone3_country_code ?? 'GH';
        
        // For backward compatibility
        if (str_starts_with($countryCode, '+')) {
            $countryCode = 'GH';
        }
        
        $countries = \App\Services\CountryCodeService::getAllCountries();
        $code = $countries[$countryCode]['code'] ?? '+233';
        
        return $code . ' ' . $this->phone3;
    }

    /**
     * Get the logo URL with fallback to default
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo && $this->logo !== 'apollo-invoice-default-logo.png') {
            return asset('storage/company_logo/' . $this->logo);
        }
        
        return asset('assets/img/pages/logo.png');
    }

}
