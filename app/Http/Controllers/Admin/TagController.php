<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function index()
    {
        return view('admin/tags/index', ['tags' => Post::all()]);
    }

    public function create(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back();
    }
}
