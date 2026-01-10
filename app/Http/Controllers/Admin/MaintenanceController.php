<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class MaintenanceController extends Controller
{
    public function toggle()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create(['maintenance' => false]);
        }

        $setting->maintenance = ! $setting->maintenance;
        $setting->save();

        return response()->json([
            'status' => $setting->maintenance
        ]);
    }
}
