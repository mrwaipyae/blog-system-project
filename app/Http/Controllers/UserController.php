<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showPosts($user,$id){
        $user = User::find( $id );
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
          // Calculate reading time for each post
          foreach ($posts as $post) {
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTimeMinutes = ceil($wordCount / 200); // Assuming an average reading speed of 200 words per minute
            $post->readingTime = $readingTimeMinutes;
        }
        $totalPosts = $user->posts()->count();
        return view('user.posts', compact('user', 'totalPosts', 'posts',));
    }
}
