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


      function calculateReadingTime($posts){
                foreach ($posts as $post) {
                $wordCount = str_word_count(strip_tags($post->content));
                $readingTimeMinutes = ceil($wordCount / 200); // Assuming an average reading speed of 200 words per minute
                $post->readingTime = $readingTimeMinutes;
            }

        }

        // Calculate reading time for $posts
        calculateReadingTime($posts);

        // Calculate reading time for $popularPosts
        calculateReadingTime($popularPosts);

        // Calculate reading time for $morePopularPosts
        calculateReadingTime($recentPosts);


        if (Auth::check()) {
            return view('home', ['posts' => $posts, 'popularPosts' => $popularPosts, 'recentPosts' => $recentPosts]);
        } else {
            return view('welcome', ['posts' => $posts, 'popularPosts' => $popularPosts, 'recentPosts' => $recentPosts]);
        }
    }

    function about(){
        return view('about');
    }
}
