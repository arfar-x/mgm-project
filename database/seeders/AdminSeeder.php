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
                'phone_number' => '09111111111',
                'email' => 'admin@domain.com',
                'password' => Hash::make('admin'),
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
