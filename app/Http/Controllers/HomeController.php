<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::inRandomOrder()->get();
        $popularPosts = Post::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(6)
            ->get();

        $recentPosts = Post::latest()->take(6)->get();
         // Calculate reading time for each post
        foreach ($posts as $post) {
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTimeMinutes = ceil($wordCount / 200); // Assuming an average reading speed of 200 words per minute
            $post->readingTime = $readingTimeMinutes;
        }

         // Calculate reading time for each post
         foreach ($popularPosts as $popularPost) {
            $wordCount = str_word_count(strip_tags($popularPost->content));
            $readingTimeMinutes = ceil($wordCount / 200); // Assuming an average reading speed of 200 words per minute
            $popularPost->readingTime = $readingTimeMinutes;
        }

        if (Auth::check()) {
            return view('home', ['posts' => $posts, 'popularPosts' => $popularPosts, 'recentPosts' => $recentPosts]);
        } else {
            return view('welcome', ['posts' => $posts, 'popularPosts' => $popularPosts, 'recentPosts' => $recentPosts]);
        }
    }
}
