<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::withTrashed()->get();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin/posts/index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }

    public function show($user, $titleAndId)
    {
        // Extract the post ID from the end of the $titleAndId string
        $id = (int) Str::afterLast($titleAndId, '-');

        // Extract the title from the $titleAndId string
        $title = Str::beforeLast($titleAndId, '-');
        $post = Post::findOrFail($id);

        return view('admin/posts/show', compact('post'));
    }


    public function newPost()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin/posts/new', ['categories' => $categories, 'tags' => $tags]);
    }

    // Upload CkEditor file
    public function uploadFile(Request $request)
    {

        $data = array();

        $validator = Validator::make($request->all(), [
            'upload' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {

            $data['uploaded'] = 0;
            $data['error']['message'] = $validator->errors()->first('upload'); // Error response

        } else {
            if ($request->file('upload')) {

                $file = $request->file('upload');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = url('uploads/' . $filename);

                // Response
                $data['fileName'] = $filename;
                $data['uploaded'] = 1;
                $data['url'] = $filepath;
            } else {
                // Response
                $data['uploaded'] = 0;
                $data['error']['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    public function create(Request $request)
    {

        // validation
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
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


        Session::flash('message', 'Post Create Successfully.');

        return redirect('admin/posts');
    }

    // public function create(Request $request)
    // {
    //     // validate input
    //     $request->validate([
    //         'title' => 'required|max:255',
    //         'content' => 'required',

    //         'category_id' => 'required',
    //     ]);

    //     // upload image (if provided)
    //     $imageName = '';
    //     if ($request->hasFile('upload')) {
    //         $originName = $request->file('upload')->getClientOriginalName();
    //         $fileName = pathinfo($originName, PATHINFO_FILENAME);
    //         $extension = $request->file('upload')->getClientOriginalExtension();
    //         $fileName = $fileName . '_' . time() . '.' . $extension;

    //         $request->file('upload')->move(public_path('media'), $fileName);

    //         $url = asset('media/' . $fileName);

    //         return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    //     }

    //     // create post
    //     $post = new Post;
    //     $post->title = $request->input('title');
    //     $post->content = $request->input('content');
    //     $post->image = $imageName;
    //     $post->category_id = $request->input('category_id');
    //     $post->user_id = auth()->user()->id;
    //     $post->save();

    //     $tags = $request->input('tags', []);
    //     $post->tags()->attach($tags);

    //     return redirect()->route('admin.posts')->with('success', 'Post created successfully.');
    // }

    public function edit($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Request $request, $id)
    {

        $post = Post::withTrashed()->findOrFail($id);

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


        return redirect('admin/posts/')->with('success', 'Post updated successfully.');
    }

    public function un_or_publish($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->deleted_at) {
            // "unpublish" the post
            $post->delete();
        } else {
            // "publish" the post
            $post->restore();
        }
        return redirect()->back();
    }


    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->back();
    }
}
