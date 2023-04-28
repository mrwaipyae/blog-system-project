<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('admin/categories/index')->with('categories', $categories);
    }

    public function create(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect()->back();
    }


    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request)
    {

        $category = Category::find($request->id);

        $category->name = $request->name;

        $category->save();

        return redirect('admin/categories/');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
