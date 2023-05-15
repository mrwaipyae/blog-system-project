<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function showPosts($tag)
{ 
    $tag = Tag::where('name', $tag)->firstOrFail();
    $posts = $tag->posts;
    return view('/tag', compact('posts'),['tag'=>$tag]);
}

}
