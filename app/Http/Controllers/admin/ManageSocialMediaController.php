<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageSocialMediaController extends Controller
{
    public function index () {
        $social = SocialMedia::select([
            'id',
            'name',
            'url'
        ])->get();
        return view('admin.social.index', [
            'social' => $social
        ]);
    }

    public function store (Request $req) {
        $req->validate([
            'name' => 'required|string|max:255|unique:social_media',
            'url' => 'required|string|max:255|unique:social_media',
        ]);
        SocialMedia::create([
            'name' => $req->name,
            'url' => $req->url,
        ]);
        return redirect()->route('manage.social')->with('success', 'Social Media Added Successfully');
    }

    public function update ($id, Request $req) {
        $social = SocialMedia::find(Crypt::decryptString($id));
        if (!$social) return back()->withErrors('Social Media not Found');
        $req->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);
        $social->update([
            'name' => $req->name,
            'url' => $req->url,
        ]);
        return redirect()->route('manage.social')->with('success', 'Social Media Updated Successfully');
    }
    
    public function destroy ($id) {
        $social = SocialMedia::find(Crypt::decryptString($id));
        if (!$social) return back()->withErrors('Social Media not Found');
        $social->delete();
        return redirect()->route('manage.social')->with('success', 'Social Media Deleted Successfully');
    }
}
