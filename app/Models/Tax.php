<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tax extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invoice(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class)->withPivot('tax-id')->withTimestamps();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
