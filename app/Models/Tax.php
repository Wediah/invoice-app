<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
//    protected $fillable = ['tax_name', 'tax_percentage', 'type'];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn($value) => strtoupper($value),
        );
    }

    public function isPrimary(): bool
    {
        return $this->type === 'PRIMARY';
    }

    public function isSecondary(): bool
    {
        return $this->type === 'SECONDARY';
    }

    public function invoice(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class)->withPivot('tax-id')->withTimestamps();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
