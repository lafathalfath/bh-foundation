<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ideas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManageIdeasController extends Controller
{
    public function index() {
        $ideas = Ideas::first();
        return view('admin.ideas.index', [
            'ideas' => $ideas
        ]);
    }

    public function update(Request $req) {
        $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'mimes:jpg,jpeg,png|max:5120',
            'major_title' => 'required|string|max:255',
            'major_description' => 'required|string|max:1000',
            'major_image' => 'mimes:jpg,jpeg,png|max:5120',
        ]);
        $data = [
            'title' => $req->title,
            'description' => $req->description,
            'major_title' => $req->major_title,
            'major_description' => $req->major_description,
        ];

        $ideas = Ideas::first();
        $target_dir = storage_path('app/public/development');
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $ideas->image_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['image_url'] = env('APP_URL').'/storage/developmnet/'.$filename;
        }

        $target_dir = storage_path('app/public/major');
        if ($req->hasFile('major_image')) {
            $filename = $req->major_image->hashName();
            $req->major_image->move($target_dir, $filename);
            $prev_path = str_replace(env('APP_URL').'/storage', '', $ideas->major_image_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['major_image_url'] = env('APP_URL').'/storage/major/'.$filename;
        }
        $ideas->update($data);
        return back()->with('success', 'Ideas Updating Successful');
    }
}
