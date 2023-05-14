<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(){
        $postCount = Post::count();
        $userCount = User::count();
        $tagCount = Tag::count();
        $posts = Post::withTrashed()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('CAST(count(*) AS UNSIGNED) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        
        return view('admin.dashboard', ['posts'=>$posts,'postCount' => $postCount,
        'userCount' => $userCount,
        'tagCount' => $tagCount]);
    }
}
