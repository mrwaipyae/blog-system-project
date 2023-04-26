<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        
        return view('admin/categories')->with('categories',$categories);
    }

    public function store(Request $request)
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

}
