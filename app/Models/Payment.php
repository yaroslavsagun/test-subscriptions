<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_subscription_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class
    ];

    /** @returns BelongsTo<CompanySubscription, Payment> */
    public function companySubscription(): BelongsTo
    {
        return $this->belongsTo(CompanySubscription::class);
    }
}
