<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class invoice extends Model
{
    use HasFactory;
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
        return $this->belongsToMany(catalog::class)->withPivot('quantity', 'discount_percent','total')->withTimestamps();
    }

    public function taxes(): BelongsToMany
    {
        return $this->belongsToMany(tax::class)->withPivot('tax_id','tax_type', 'tax_percentage', 'tax_amount')->withTimestamps();
    }

    public function paymentTerms(): BelongsTo
    {
        return $this->belongsTo(paymentTerms::class, 'term_id');
    }

    public function customerInfo(): HasOne
    {
        return $this->hasOne(customerInfo::class);
    }
}
