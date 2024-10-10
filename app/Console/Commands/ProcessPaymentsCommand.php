<?php

namespace App\Console\Commands;

use App\Enums\PaymentStatusEnum;
use App\Models\CompanySubscription;
use Illuminate\Console\Command;

class ProcessPaymentsCommand extends Command
{
    protected $signature = 'app:process-payments';

    protected $description = 'Process subscription payments';

    public function handle(): void
    {
        CompanySubscription::query()
            ->where('end_date', now()->subDay()->format('Y-m-d'))
            ->get()
            ->each(function (CompanySubscription $companySubscription) {
                $companySubscription->current_subscription_id = $companySubscription->next_subscription_id;
                $companySubscription->current_period = $companySubscription->next_period;
                $companySubscription->start_date = now();
                $companySubscription->end_date = now()->addMonths($companySubscription->current_period == 'month' ? 1 : 12);
                $companySubscription->save();

                $companySubscription->payments()->create([
                    'amount' => $this->calculateAmount($companySubscription),
                    'status' => PaymentStatusEnum::COMPLETED,
                ]);

        });
    }

    private function calculateAmount(CompanySubscription $companySubscription): int
    {
        if($companySubscription->current_period == 'month'){
            $pricePerUser = $companySubscription->currentSubscription->month_price;
        } else {
            $pricePerUser = $companySubscription->currentSubscription->year_price;
        }
        return $pricePerUser * $companySubscription->company->number_of_users;
    }
}
