<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\Member;
use App\Models\mMemberLevel;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class ManageAboutController extends Controller
{
    public function index() {
        $about = AboutPage::select([
            'title',
            'description',
            'image_1_url',
            'image_2_url',
            'vision',
            'mision',
            'bg_color',
            'partners_title',
            'partners_description',
            'is_hero_visible',
            'is_vision_visible',
            'is_members_visible',
            'is_programs_visible',
            'is_partners_visible'
        ])->first();
        $member_level = mMemberLevel::select(['id', 'name'])->get();
        $partners = Partner::select(['id', 'name', 'url', 'image_url'])->orderBy('id', 'desc')->get();
        return view('admin.about_page.index', [
            'about' => $about,
            'member_level' => $member_level,
            'partners' => $partners
        ]);
    }
    
    public function update(Request $req) {
        // dd($req->all());
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
            'is_hero_visible' => $req->is_hero_visible ?? false,
            'is_vision_visible' => $req->is_vision_visible ?? false,
            'is_members_visible' => $req->is_members_visible ?? false,
            'is_programs_visible' => $req->is_programs_visible ?? false,
            'is_partners_visible' => $req->is_partners_visible ?? false,
        ];
        $target_dir = storage_path('app/public/about');
        if ($req->hasFile('image_1')) {
            $filename = $req->image_1->hashName();
            $req->logo->move($target_dir, $filename);
            $prev_path = str_replace('/storage', '', $about->logo_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['image_1_url'] = '/storage/about/'.$filename;
        }
        if ($req->hasFile('image_2')) {
            $filename = $req->image_2->hashName();
            $req->logo->move($target_dir, $filename);
            $prev_path = str_replace('/storage', '', $about->logo_url);
            if (File::exists(storage_path('app/public').$prev_path)) File::delete(storage_path('app/public').$prev_path);
            $data['image_2_url'] = '/storage/about/'.$filename;
        }
        $about->update($data);
        return back()->with('success', 'About Page Updated Successfully');
    }

    public function addPartners(Request $req) {
        $req->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:5120'
        ]);
        $data = [
            'name' => $req->name,
            'url' => $req->url,
        ];
        $target_dir = storage_path('app/public/partners');
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            $data['image_url'] = "/storage/partners/$filename";
        }
        Partner::create($data);
        return back()->with('success', 'Add partner successful')->withInput();
    }

    public function updateParters($id, Request $req) {
        $id = Crypt::decryptString($id);
        $partner = Partner::find($id);
        if (!$partner) return back()->withErrors('Partner not found');
        $req->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png|max:5120'
        ]);
        $data = [
            'name' => $req->name,
            'url' => $req->url
        ];
        $target_dir = storage_path('app/public/partners');
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            $prev_path = str_replace('/storage/partners', '', $partner->image_url);
            if ($partner->image_url && File::exists($target_dir)."/$prev_path") File::delete($target_dir)."/$prev_path";
            $data['image_url'] = "/storage/partners/$filename";
        }
        $partner->update($data);
        return back()->with('success', 'Partner updated successfully')->withInput();
    }

    public function destroyPartner($id) {
        $id = Crypt::decryptString($id);
        $partner = Partner::find($id);
        if (!$partner) return back()->withErrors('Partner not found');
        $target_dir = storage_path('app/public/partners');
        $prev_path = str_replace('/storage/partners', '', $partner->image_url);
        if ($partner->image_url && File::exists($target_dir)."/$prev_path") File::delete($target_dir)."/$prev_path";
        $partner->delete();
        return back()->with('success', 'Partner deleted successfully')->withInput();
    }

    public function addMember(Request $req) {
        $req->validate([
            'level_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|mimes:jpg,jpeg,png|max:5120',
        ]);
        $data = [
            'level_id' => $req->level_id,
            'name' => $req->name,
            'position' => $req->position,
        ];
        $target_dir = storage_path('app/public/members');
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            $data['image_url'] = "/storage/members/$filename";
        }
        Member::create($data);
        return back()->with('success', 'Member added successfully');
    }

    public function updateMember($id, Request $req) {
        $member = Member::find(Crypt::decryptString($id));
        if (!$member) return back()->withErrors('Member not found')->withInput();
        $req->validate([
            'level_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'mimes:jpg,jpeg,png|max:5120',
        ]);
        $data = [
            'level_id' => $req->level_id,
            'name' => $req->name,
            'position' => $req->position,
        ];
        $target_dir = storage_path('app/public/members');
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            $prev_path = str_replace('/storage', storage_path('app/public'), $member->image_url);
            if (File::exists($prev_path)) File::delete($prev_path);
            $data['image_url'] = "/storage/members/$filename";
        }
        $member->update($data);
        return back()->with('success', 'Member updated successfully')->withInput();
    }

    public function destroyMember($id) {
        $member = Member::find(Crypt::decryptString($id));
        if (!$member) return back()->withErrors('Member not found')->withInput();
        $prev_path = str_replace('/storage', storage_path('app/public'), $member->image_url);
        if (File::exists($prev_path)) File::delete($prev_path);
        $member->delete();
        return back()->with('success', 'Member deleted successfully')->withInput();
    }
}
