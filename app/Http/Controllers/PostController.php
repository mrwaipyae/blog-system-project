<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('/welcome', ['posts' => $posts]);
    }

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
        $categories = Category::all();
        $tags = Tag::all();
        return view('/new',['categories'=>$categories,'tags'=>$tags]);
    }
}
