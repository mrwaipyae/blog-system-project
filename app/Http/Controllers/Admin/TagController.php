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

}
