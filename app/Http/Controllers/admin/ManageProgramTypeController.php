<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\mProgramType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageProgramTypeController extends Controller
{
    public function index () {
        $program_type = mProgramType::select(['id', 'name'])->get();
        return view('admin.program_type.index', [
            'program_type' => $program_type
        ]);
    }

    public function store (Request $req) {
        $req->validate(['name' => 'required|string|max:255|unique:m_program_type']);
        $name = ucfirst(strtolower($req->name));
        mProgramType::create(['name' => $name]);
        return redirect()->route('manage.program_type')->with('success', 'Program Type Added Successfully');
    }

    public function update ($id, Request $req) {
        $program_type = mProgramType::find(Crypt::decryptString($id));
        if (!$program_type) return back()->withErrors('Article Type not Found');
        $req->validate(['name' => 'required|string|max:255']);
        $name = ucfirst(strtolower($req->name));
        $affected = count($program_type->program);
        $program_type->update(['name' => $name]);
        return redirect()->route('manage.program_type')->with('success', "Program Type Updated Successfully $affected data affected");
    }

    public function destroy ($id) {
        $program_type = mProgramType::find(Crypt::decryptString($id));
        if (!$program_type) return back()->withErrors('Article Type not Found');
        if (count($program_type->program)) return back()->withErrors('This Article type in use for some Articles');
        $program_type->delete();
        return redirect()->route('manage.program_type')->with('success', 'Program Type Deleted Successfully');
    }
}
