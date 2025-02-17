<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManageAboutController extends Controller
{
    public function index() {
        $about = AboutPage::first();
        return view('admin.about_page.index', [
            'about' => $about,
        ]);
    }
    
    public function update(Request $req) {
        $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_1' => 'mimes:jpg,jpeg,png|max:5120',
            'image_2' => 'mimes:jpg,jpeg,png|max:5120',
            'vision' => 'required|string',
            'mision' => 'required|string',
            'bg_color' => 'string',
            'partners_title' => 'required|string|max:255',
            'partners_description' => 'required|string',
            'is_hero_visible' => 'boolean',
            'is_vision_visible' => 'boolean',
            'is_members_visible' => 'boolean',
            'is_programs_visible' => 'boolean',
            'is_partners_visible' => 'boolean',
        ]);
        $about = AboutPage::first();
        $data = [
            'title' => $req->title,
            'description' => $req->description,
            'vision' => $req->vision,
            'mision' => $req->mision,
            'bg_color' => $req->bg_color,
            'partners_title' => $req->partners_title,
            'partners_description' => $req->partners_description,
            'is_hero_visible' => $req->is_hero_visible,
            'is_vision_visible' => $req->is_vision_visible,
            'is_members_visible' => $req->is_members_visible,
            'is_programs_visible' => $req->is_programs_visible,
            'is_partners_visible' => $req->is_partners_visible,
        ];
        $target_dir = storage_path('app/public/about');
        if ($req->hasFile('image_1')) {
            $filename = $req->image_1->hashName();
            $req->logo->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $about->logo_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['image_1_url'] = env('APP_URL').'/storage/about/'.$filename;
        }
        if ($req->hasFile('image_2')) {
            $filename = $req->image_2->hashName();
            $req->logo->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $about->logo_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['image_2_url'] = env('APP_URL').'/storage/about/'.$filename;
        }
        $about->update($data);
        return back()->with('success', 'About Page Updated Successfully');
    }
}
