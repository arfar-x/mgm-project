<?php

namespace Database\Seeders;

use App\Services\SettingService\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now()->toDateTimeString();

        Setting::query()->insert([
            [
                'title' => 'شماره تلفن',
                'slug' => 'phone-number',
                'value' => '0511112233',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'شماره واتساپ',
                'slug' => 'whatsapp-number',
                'value' => '09123456789',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'شماره موبایل',
                'slug' => 'mobile',
                'value' => '09123456789',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'آدرس',
                'slug' => 'address',
                'value' => 'مشهد بزرگراه آسیایی',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'شعار اصلی',
                'slug' => 'slogan-main',
                'value' => 'متن شعار اصلی',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'شعار فوتر',
                'slug' => 'slogan-footer',
                'value' => 'شعار در فوتر',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'کپی رایت',
                'slug' => 'copyright',
                'value' => 'متن کپی رایت',
                'type' => 'info',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
