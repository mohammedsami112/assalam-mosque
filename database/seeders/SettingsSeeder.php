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
            'value' => 'https://maps.app.goo.gl/KdPQR5fSTitBBDD78'
        ]);
        Setting::create([
            'name' => 'facebook',
            'value' => 'https://www.facebook.com/profile.php?id=100040504191915'
        ]);
        Setting::create([
            'name' => 'youtube',
            'value' => 'https://www.youtube.com/@assalammoschee'
        ]);
        Setting::create([
            'name' => 'instagram',
            'value' => 'https://www.instagram.com/moscheeassalam'
        ]);
        Setting::create([
            'name' => 'tiktok',
            'value' => 'https://www.tiktok.com/@moscheeassalam'
        ]);
        Setting::create([
            'name' => 'stripe_secret_key',
            'value' => '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'
        ]);
        Setting::create([
            'name' => 'stripe_publish_key',
            'value' => 'pk_live_51OsoxCRv40UjEvDxK1D3u8OG7rs3FnvxbQc7lij7jalGgOU0YRShauJjAnJv9nHLHFcsWi2AY2SzkM2CRoZGh76u00gGJLLG1d'
        ]);
        Setting::create([
            'name' => 'paypal_mode',
            'value' => 'live'
        ]);
        Setting::create([
            'name' => 'paypal_client_id',
            'value' => 'AZGB_SxlpSZE8P6ZAMhYABIXsujeg-3FuA6YJMLVhsHZZtptfx1c_4LBq-Um5BLvdWEsrSnU8Yz4KQpi'
        ]);
        Setting::create([
            'name' => 'paypal_secret_id',
            'value' => 'EPdwT5OdLDD-qCGDJhFfO9Z5K8JIleciTD0K6cN4q8bIiRQYr2BO0C0fLETULl3aGV7TKChEbJtoR5n3'
        ]);
        Setting::create([
            'name' => 'paypal_app_id',
            'value' => 'MAAN - Arabischer Treff in sterreich'
        ]);
    }
}
