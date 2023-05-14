<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     $postCount = Post::count();
    //     $userCount = User::count();
    //     $tagCount = Tag::count();

    //     $postsPerMonth = DB::table('posts')
    //             ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
    //             ->groupBy(DB::raw('MONTH(created_at)'))
    //             ->get();


    //     // Pass the $postsPerMonth data to the view and display it on the chart
    //     return view('admin.dashboard', ['postsPerMonth' => $postsPerMonth,'postCount' => $postCount,
    //     'userCount' => $userCount,
    //     'tagCount' => $tagCount]);
    // }
}
