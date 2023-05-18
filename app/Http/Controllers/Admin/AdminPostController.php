<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::withTrashed()->get();
        $tags = Tag::all();
        return view('admin/posts/index', ['posts' => $posts, 'tags' => $tags]);
    }

    public function records(Request $request)
    {
        if ($request->ajax()) {
 
            if ($request->input('start_date') && $request->input('end_date')) {
 
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));
 
                if ($end_date->greaterThan($start_date)) {
                    $students = Post::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $students = Post::latest()->get();
                }
            } else {
                $students = Post::latest()->get();
            }
            return response()->json([
                'students' => $students
            ]);
        } else {
            abort(403);
        }
    }

    public function show($user, $titleAndId)
    {
        // Extract the post ID from the end of the $titleAndId string
        $id = (int) Str::afterLast($titleAndId, '-');
        // Extract the title from the $titleAndId string
        $title = Str::beforeLast($titleAndId, '-');
        // Retrieve the post including any deleted ones
        $post = Post::withTrashed()->findOrFail($id);
        return view('admin/posts/show', compact('post'));
    }


    public function newPost()
    {
        $tags = Tag::all();
        return view('admin/posts/new', [ 'tags' => $tags]);
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
            'tags' => 'required|array',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'required|array',  
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
        $post->user_id = auth()->user()->id;
        $post->save();
        // attach tags to post
        $tags = $request->input('tags', []);
        if (!empty($tags)) {
            $post->tags()->attach($tags);
        }
        Session::flash('message', 'Post Create Successfully.');
        return redirect('admin/posts');
    }

    public function edit($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $tags = Tag::all();
        $postTagIds = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'tags', 'postTagIds'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|exists:tags,id',
        ]);
        $post->title = $request->title;
        $post->content = $request->content;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $post->image = $imageName;
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
