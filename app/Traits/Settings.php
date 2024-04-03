<?php

namespace App\Traits;

use App\Models\Setting;

trait Settings
{

    public function getSettings($setting = []) {
        $settings = Setting::whereIn('name', $setting)->get()->toArray();

        $settingsData = [];
        foreach ($settings as $key => $setting) {
            $settingsData[$setting['name']] = ['value' => $settings[$key]['value']];
        }

        return $settingsData;

    }

}
