<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin/posts/index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }
    //['posts', $posts, 'categories' => $categories]

    public function create(Request $request)
    {

        // validation
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
        ]);

        // upload image
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);
        }

        // create post
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $imageName;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('admin.posts')->with('success', 'Post created successfully.');
    }
}
