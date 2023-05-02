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

    public function newPost(){
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin/posts/new-post', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }

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

        $tags = $request->input('tags', []);
        $post->tags()->attach($tags);

        return redirect()->route('admin.posts')->with('success', 'Post created successfully.');
    }

    public function edit($id){
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit',['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tags' => 'nullable|array',
                'tags.*' => 'nullable|exists:tags,id',
            ]);

            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->content = $request->content;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $filename);
            $post->image = $filename;
        }

        $post->tags()->sync($request->tags);

        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully.');
    }


    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
}
