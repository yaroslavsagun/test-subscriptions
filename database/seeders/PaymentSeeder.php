<?php

namespace Database\Seeders;

use App\Enums\PaymentStatusEnum;
use App\Models\CompanySubscription;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companySubscription = CompanySubscription::query()->first();
        if(!$companySubscription){
            return;
        }
        Payment::query()->create([
            'company_subscription_id' => $companySubscription->id,
            'amount' => 28,
            'status' => PaymentStatusEnum::COMPLETED,
            'created_at' => '2024-09-20 10:00:00',
            'updated_at' => '2024-09-20 10:00:00'
        ]);
    }
}
