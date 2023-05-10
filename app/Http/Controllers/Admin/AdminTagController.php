<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;


class AdminTagController extends Controller
{
    public function index()
    {
        return view('admin/tags/index', ['tags' => Tag::all()]);
    }

    public function create(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back();
    }

    public function destroy($id){
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->back()->with('success', 'Tag updated successfully.');
    }

    public function view(Request $request){
    
        $tag = Tag::find($request->id);
        $tagPosts = $tag->posts()->orderBy('created_at', 'desc')->paginate(10);
        $totalPosts = $tag->posts()->count();
    
        return view('admin/tags/view', compact('tag', 'totalPosts', 'tagPosts'));
    }

}
