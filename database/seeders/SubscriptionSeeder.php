<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::query()->insert($this->getSubscriptions());
    }

    private function getSubscriptions(): array
    {
        return [
            [
                'name' => 'Lite',
                'month_price' => 4,
                'year_price' => intval(4 * 12 * 0.8),
            ],
            [
                'name' => 'Starter',
                'month_price' => 6,
                'year_price' => intval(6 * 12 * 0.8),
            ],
            [
                'name' => 'Premium',
                'month_price' => 10,
                'year_price' => intval(10 * 12 * 0.8),
            ]
        ];
    }
}
