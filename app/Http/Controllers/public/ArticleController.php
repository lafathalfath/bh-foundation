<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\mProgramType;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ArticleController extends Controller
{
    public function index($type, $id) {
        $id = Crypt::decryptString($id);
        $program = Program::find($id);
        if (!Auth::check()) {
            if (!$program->published) return back();
            $program->update(['views' => $program->views + 1]);
        }
        $type = ucfirst($type);
        $program_type = mProgramType::select('id')->where('name', $type)->first();
        
        if ($program_type) {
            $related = $program_type->program()->select([
                'id',
                'type_id',
                'title',
                'image_url',
                'views',
                'published_at',
            ])->where('id', '!=', $id)->where('published', true)->latest()->take(3)->get();
        } else {
            $related = []; // fallback jika type tidak valid seperti 'all'
        }        
        return view('public.article', [
            'program' => $program,
            'related' => $related,
        ]);
    }
}

