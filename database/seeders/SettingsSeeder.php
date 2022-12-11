<?php

namespace Database\Seeders;

use App\Services\SettingService\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Setting::query()->create([
            'title' => 'شماره تلفن',
            'slug' => 'phone-number',
            'value' => '0511112233',
            'type' => ''
        ]);
    }
}
