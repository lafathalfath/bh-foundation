<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\mProgramType;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ArticleController extends Controller
{
    public function index($type, $id) {
        $id = Crypt::decryptString($id);
        $program = Program::find($id);
        if (!$program->published) return back();
        $type = ucfirst($type);
        $program_type = mProgramType::select('id')->where('name', $type)->first();
        $related = $program_type->program()->select([
            'type_id',
            'title',
            'image_url',
            'description',
            'views',
            'published',
        ])->where('id', '!=', $id)->latest()->take(3)->get();
        return view('public.article', [
            'program' => $program,
            'related' => $related,
        ]);
    }
}

