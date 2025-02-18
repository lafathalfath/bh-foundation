<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\mProgramType;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class ManageProgramController extends Controller
{
    public function index(Request $req) {
        $program_types = mProgramType::select(['id', 'name'])->get();
        $programs = [];
        foreach ($program_types as $pt) {
            $programs[$pt->name] = Program::where('type_id', $pt->id)
                ->select([
                    'id',
                    'title',
                    'image_url',
                    'description',
                    'views',
                    'published',
                ])
                ->paginate(10);
        }
        return view('admin.programs.index', [
            'programs' => $programs,
            'program_types' => $program_types,
        ]);
    }

    public function create($type) {
        $type = ucfirst($type);
        $program_type_id = mProgramType::select('id')->where('name', $type)->first()->id;
        return view('admin.programs.create', [
            'program_type_id' => $program_type_id,
            'type' => $type,
        ]);
    }

    public function store(Request $req) {
        $req->validate([
            'type_id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'image' => 'required|mimes:jpg,jpeg,png|max:5120',
            'description' => 'required|string',
        ]);
        $data = [
            'type_id' => $req->type_id,
            'title' => $req->title,
            'description' => $req->description,
        ];
        $target_dir = storage_path('app/public/articles');
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            $data['image_url'] = "/storage/articles/$filename";
        }
        Program::create($data);
        return redirect()->route('manage.article')->with('success', 'New Article Created Successfully');
    }

    public function edit($id) {
        $program = Program::find(Crypt::decryptString($id));
        if (!$program) return back()->withErrors('Article Not Found');
        return view('admin.programs.edit', [
            'program' => $program,
        ]);
    }

    public function update($id, Request $req) {
        $program = Program::find(Crypt::decryptString($id));
        if (!$program) return back()->withErrors('Article Not Found');
        $req->validate([
            'type_id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'image' => 'mimes:jpg,jpeg,png|max:5120',
            'description' => 'required|string',
        ]);
        $data = [
            'type_id' => $req->type_id,
            'title' => $req->title,
            'description' => $req->description,
        ];
        $target_dir = storage_path('app/public/articles');
        $prev_file = str_replace('/storage/articles', $target_dir, $program->image_url);
        if ($req->hasFile('image')) {
            $filename = $req->image->hashName();
            $req->image->move($target_dir, $filename);
            if (File::exists($prev_file)) File::delete($prev_file);
            $data['image_url'] = "/storage/articles/$filename";
        }
    }

    public function publish($id) {
        $program = Program::find(Crypt::decryptString($id));
        if (!$program) return back()->withErrors('Article Not Found');
        $program->update(['published' => true]);
        return redirect()->route('manage.article')->with('success', 'Article Published Successfully');
    }

    public function destroy($id) {
        $program = Program::find(Crypt::decryptString($id));
        if (!$program) return back()->withErrors('Article Not Found');
        $target_dir = storage_path('app/public/articles');
        $prev_file = str_replace('/storage/articles', $target_dir, $program->image_url);
        if (File::exists($prev_file)) File::delete($prev_file);
        $program->delete();
        return redirect()->route('manage.article')->with('success', 'Article Deleted Successfully');
    }
}
