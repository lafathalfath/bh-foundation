<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

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
            'is_hero_visible' => 'boolean',
        ]);
    }
}
