<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'phone_number',
            'value' => '+436503539161'
        ]);
        Setting::create([
            'name' => 'email',
            'value' => 'info@assalam.at'
        ]);
        Setting::create([
            'name' => 'address1',
            'value' => 'Mariazellerstraße 31 EG, 3100'
        ]);
        Setting::create([
            'name' => 'address2',
            'value' => 'St. Pölten , Austria'
        ]);
    }
}
