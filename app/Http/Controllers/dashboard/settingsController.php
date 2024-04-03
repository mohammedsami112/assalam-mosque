<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class settingsController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('settings')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getSettings() {
        $settings = Setting::all();

        return $this->success($settings);
    }

    public function updateSettings(Request $request) {
        $validate = Validator::make($request->all(), [
            'phone_number' => 'required',
            'email' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'stripe_secret_key' => 'required',
            'stripe_publish_key' => 'required',
            'paypal_mode' => 'required',
            'paypal_client_id' => 'required',
            'paypal_secret_id' => 'required',
            'paypal_app_id' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        foreach ($request->all() as $key => $value) {
            $setting = Setting::where('name', '=', $key);

            $setting->update([
                'name' => $key,
                'value' => $value
            ]);
        }

        return $this->success(null, 'Settings Updated Successfully');

    }

}
