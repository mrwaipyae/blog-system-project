<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    // public function index()
    // {
    //     $posts = Post::all();
    //     return view('/welcome', ['posts' => $posts]);
    // }

   

    public function view($user, $titleAndId)
    {
        // Extract the post ID from the end of the $titleAndId string
        $id = (int) Str::afterLast($titleAndId, '-');

        // Extract the title from the $titleAndId string
        $title = Str::beforeLast($titleAndId, '-');
        // $post = Post::findOrFail($id);
        $post = Post::with('commentsWithUser')->find($id);


        return view('/view', compact('post'));
    }

    public function new(){
        $tags = Tag::all();
        return view('/new',['tags'=>$tags]);
    }

    
    public function create(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
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
        $tags = $request->input('tags', []);
        $post->tags()->attach($tags);


        Session::flash('message', 'Post Create Successfully.');

        return redirect('/');
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

     public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        return view('post.edit', ['post' => $post, 'tags' => $tags]);
    }

    public function update(Request $request, $id)
    {
     
        $post = Post::findOrFail($id);
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
        return redirect('me')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->forceDelete();
        return redirect()->back();
    }
}
