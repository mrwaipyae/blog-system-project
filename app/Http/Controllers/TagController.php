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
         // Calculate reading time for each post
        foreach ($posts as $post) {
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTimeMinutes = ceil($wordCount / 200); // Assuming an average reading speed of 200 words per minute
            $post->readingTime = $readingTimeMinutes;
        }
        return view('/tag', compact('posts'),['tag'=>$tag]);
    }

}
