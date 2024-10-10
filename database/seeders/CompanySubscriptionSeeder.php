<?php

namespace Database\Seeders;

use App\Enums\SubscriptionPeriodEnum;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class CompanySubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::query()->first();
        $subscription = Subscription::query()->where('name', 'Lite')->first();
        if(!$company || !$subscription){
            return;
        }

        CompanySubscription::query()->create([
            'company_id' => $company->id,
            'current_period' => SubscriptionPeriodEnum::MONTH,
            'next_period' => SubscriptionPeriodEnum::MONTH,
            'current_subscription_id' => $subscription->id,
            'next_subscription_id' => $subscription->id,
            'start_date' => '2024-09-20',
            'end_date' => '2024-10-20'
        ]);
    }
}
