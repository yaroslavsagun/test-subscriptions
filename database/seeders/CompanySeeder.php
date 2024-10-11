<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();
        if(!$user){
            return;
        }

        Company::query()->create([
            'name' => 'John Doe & Partners Co.',
            'owner_id' => $user->id,
            'number_of_users' => 7
        ]);
    }
}
