<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\mMemberLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageMemberLevelController extends Controller
{
    public function index () {
        $member_level = mMemberLevel::select(['id', 'name'])->get();
        return view('admin.member_level.index', [
            'member_level' => $member_level
        ]);
    }

    public function store (Request $req) {
        $req->validate(['name' => 'required|string|max:255|unique:m_member_level']);
        $name = ucfirst(strtolower($req->name));
        mMemberLevel::create(['name' => $name]);
        return redirect()->route('manage.member_level')->with('success', 'Member Category Added Successfully');
    }

    public function update ($id, Request $req) {
        $member_level = mMemberLevel::find(Crypt::decryptString($id));
        if (!$member_level) return back()->withErrors('Member Category not Found');
        $req->validate(['name' => 'required|string|max:255|unique:m_member_level']);
        $name = ucfirst(strtolower($req->name));
        $affected = count($member_level->member);
        $member_level->update(['name' => $name]);
        return redirect()->route('manage.member_level')->with('success', "Member Category Updated Successfully. $affected data affected");
    }

    public function destroy ($id) {
        $member_level = mMemberLevel::find(Crypt::decryptString($id));
        if (!$member_level) return back()->withErrors('Member Category not Found');
        if (count($member_level->member)) return back()->withErrors('this member category in use of some members');
        $member_level->delete();
        return back()->with('success', 'Member Category Deleted Successfully');
    }
}
