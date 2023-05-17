<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;

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

        // Get top writers based on the number of posts
        $topWriters = User::whereIn('id', $tag->posts->pluck('user_id'))
        ->withCount('posts')
        ->orderByDesc('posts_count')
        ->take(5)
        ->get();

        // Get total number of posts and users that use the tag
        $totalPosts = $tag->posts->count();
        $totalUsers = $tag->posts()->distinct('user_id')->count();
        return view('/tag', compact('posts', 'tag', 'totalPosts', 'totalUsers','topWriters'));
    }

}
