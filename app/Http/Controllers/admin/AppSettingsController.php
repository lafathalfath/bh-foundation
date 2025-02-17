<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AppSettingsController extends Controller
{
    public function index() {
        $settings = AppSettings::first();
        return view('admin.app_settings.index', [
            'settings' => $settings
        ]);
    }

    public function update(Request $req) {
        // dd(env('APP_URL'));
        $req->validate([
            'app_name' => 'required|string|max:255',
            'logo' => 'mimes:jpg,jpeg,png|max:5120',
            'logo_banner' => 'mimes:jpg,jpeg,png|max:5120',
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'accent_color' => 'required|string',
            'info_color' => 'required|string',
        ]);
        $data = [
            'app_name' => $req->app_name,
            'primary_color' => $req->primary_color,
            'secondary_color' => $req->secondary_color,
            'accent_color' => $req->accent_color,
            'info_color' => $req->info_color,
        ];
        $settings = AppSettings::first();
        $target_dir = storage_path('app/public/app_settings');
        if ($req->hasFile('logo')) {
            $filename = $req->logo->hashName();
            $req->logo->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $settings->logo_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['logo_url'] = env('APP_URL').'/storage/app_settings/'.$filename;
        }
        if ($req->hasFile('logo_banner')) {
            $filename = $req->logo_banner->hashName();
            $req->logo_banner->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $settings->logo_banner_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['logo_banner_url'] = env('APP_URL').'/storage/app_settings/'.$filename;
        }
        $settings->update($data);
        return back()->with('success', 'App Settings Updating Successful');
    }
}
