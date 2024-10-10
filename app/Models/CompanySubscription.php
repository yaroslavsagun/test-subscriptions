<?php

namespace App\Models;

use App\Enums\SubscriptionPeriodEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int company_id
 * @property string current_period
 * @property string next_period
 * @property int current_subscription_id
 * @property int next_subscription_id
 * @property Carbon start_date
 * @property Carbon end_date
 * @property Subscription currentSubscription
 * @property Subscription nextSubscription
 * @property Company company
 */
class CompanySubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'current_period',
        'next_period',
        'current_subscription_id',
        'next_subscription_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'current_period' => SubscriptionPeriodEnum::class,
        'next_period' => SubscriptionPeriodEnum::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function currentSubscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'current_subscription_id');
    }

    public function nextSubscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'next_subscription_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
