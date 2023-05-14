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
        $posts = Post::all();
        $popularPosts = Post::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(6)
            ->get();

        $recentPosts = Post::latest()->take(6)->get();



        if (Auth::check()) {
            return view('home', ['posts' => $posts, 'popularPosts' => $popularPosts, 'recentPosts' => $recentPosts]);
        } else {
            return view('welcome', ['posts' => $posts, 'popularPosts' => $popularPosts, 'recentPosts' => $recentPosts]);
        }
    }
}
