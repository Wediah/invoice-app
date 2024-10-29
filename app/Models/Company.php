<?php

namespace App\Models;

use App\Models\Tax;
use App\Models\invoice;
use App\Models\CompanyCategory;
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
        return $this->hasMany(invoice::class);
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

    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }

}
