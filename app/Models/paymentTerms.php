<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class paymentTerms extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(company::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(invoice::class);
    }
}
