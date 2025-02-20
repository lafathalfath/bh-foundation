<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\mCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageCategoryController extends Controller
{
    public function index () {
        $categories = mCategory::select(['id', 'name'])->get();
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function store (Request $req) {
        $req->validate([
            'name' => 'required|string|max:255|unique:m_category'
        ]);
        mCategory::create(['name' => $req->name]);
        return redirect()->route('manage.categories')->with('success', 'Add Category Successful');
    }

    public function update ($id, Request $req) {
        $category = mCategory::find(Crypt::decryptString($id));
        if (!$category) return back()->withErrors('Category not found');
        $req->validate(['name' => 'required|string|max:255']);
        $affected = 0;
        if (count($category->program)) $affected = count($category->program);
        $category->update(['name' => $req->name]);
        return redirect()->route('manage.categories')->with('success', "Category updated successfully $affected data affected");
    }
    
    public function destroy ($id) {
        $category = mCategory::find(Crypt::decryptString($id));
        if (!$category) return back()->withErrors('Category not found');
        if (count($category->program)) return back()->withErrors('This category in use for some programs');
        $category->delete();
        return redirect()->route('manage.categories')->with('success', 'Category deleted successfully');
    }
}
