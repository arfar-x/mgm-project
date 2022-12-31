<?php

namespace Database\Seeders;

use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->toDateTimeString();

        User::query()->insert([
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'username' => 'admin',
                'mobile' => '09111111111',
                'mobile_verified_at' => $now,
                'email' => 'admin@domain.com',
                'email_verified_at' => $now,
                'password' => Hash::make('admin'),
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
