<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            SubscriptionSeeder::class,
            CompanySubscriptionSeeder::class,
            PaymentSeeder::class
        ]);
    }
}
