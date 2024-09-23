<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice extends Model
{
    use HasFactory, softDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company():  BelongsTo
    {
        return $this->belongsTo(company::class);
    }

    public function catalogs(): BelongsToMany
    {
        return $this->belongsToMany(catalog::class)
                    ->withPivot('quantity', 'discount_percent')
                    ->withTimestamps();
    }

    public function taxes(): BelongsToMany
    {
        return $this->belongsToMany(tax::class)
                    ->withPivot('tax_id')
                    ->withTimestamps()
                    ->withTrashed();
    }

    public function paymentTerms(): BelongsTo
    {
        return $this->belongsTo(paymentTerms::class, 'term_id');
    }

    public function customerInfo(): HasMany
    {
        return $this->hasMany(customerInfo::class);
    }
}
