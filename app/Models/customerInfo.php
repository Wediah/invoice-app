<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class customerInfo extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'invoice_customer_info';
    // protected $guarded = [];
    protected $fillable = [
        'invoice_id',
        'company_id',
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_mobile',
        'customer_phone',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
