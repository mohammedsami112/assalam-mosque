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
            'name' => 'google_map',
            'value' => '#'
        ]);
        Setting::create([
            'name' => 'facebook',
            'value' => '#'
        ]);
        Setting::create([
            'name' => 'youtube',
            'value' => '#'
        ]);
        Setting::create([
            'name' => 'instagram',
            'value' => '#'
        ]);
        Setting::create([
            'name' => 'tiktok',
            'value' => '#'
        ]);
        Setting::create([
            'name' => 'stripe_secret_key',
            'value' => 'sk_test_51MP9KJBZ4PVMyN0P2RbbTdB1cKVBubyPHStNQnNKbYZxc3Ho2D5xzOPY6CsNhtNr78AcggJzSEDYYs0QLSsOegaA00oYkO4nNC'
        ]);
        Setting::create([
            'name' => 'stripe_publish_key',
            'value' => 'pk_test_51MP9KJBZ4PVMyN0Ptoo8lrAxvMaKiEg5Y9HYOPH6MusMHT8Le17nyVOcUY5PKmG4s2oUjnWJMJh1mRPT3axXxHZ900mVN69quY'
        ]);
        Setting::create([
            'name' => 'paypal_mode',
            'value' => 'sandbox'
        ]);
        Setting::create([
            'name' => 'paypal_client_id',
            'value' => 'AXlvQ7QA51orb1l5U5TA487nmV-njIp8pD-TRg-hwLmy76Fy6ZvzzA0f6Mxt7v1Qs26BC-KI4sT9bJHf'
        ]);
        Setting::create([
            'name' => 'paypal_secret_id',
            'value' => 'EMI4q218LCDB3l55CQbE6f7BFaQMcRGzNmLVY7ToEReQE9jLsB5Jps4H50tcawqPQBIquvxNY4cdc4pm'
        ]);
        Setting::create([
            'name' => 'paypal_app_id',
            'value' => 'APP-80W284485P519543T'
        ]);
    }
}
