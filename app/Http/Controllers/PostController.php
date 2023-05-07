<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $post = Post::findOrFail($id);

        return view('/view', compact('post'));
    }
}
