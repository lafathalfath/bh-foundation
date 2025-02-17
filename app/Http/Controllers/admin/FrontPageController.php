<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FrontPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FrontPageController extends Controller
{
    public function index() {
        $front_page = FrontPage::first();
        return view('admin.front_page.index', [
            'front_page' => $front_page
        ]);
    }

    public function update(Request $req) {
        $req->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string|max:500',
            'hero_image' => 'mimes:jpg,jpeg,png|max:5120',
            'hero_bg_color' => 'required|string',
        ]);
        $data = [
            'hero_title' => $req->hero_title,
            'hero_description' => $req->hero_description,
            'hero_bg_color' => $req->hero_bg_color,
        ];

        $front_page = FrontPage::first();
        $target_dir = storage_path('app/public/app_settings');
        if ($req->hasFile('hero_image')) {
            $filename = $req->hero_image->hashName();
            $req->hero_image->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $front_page->hero_image_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['hero_image_url'] = env('APP_URL').'/storage/app_settings/'.$filename;
        }
        $front_page->update($data);
        return back()->with('success', 'Front Page Updating Successful');
    }
}
