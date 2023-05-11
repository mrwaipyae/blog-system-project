<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AdminDashboardController extends Controller
{
    public function index(){
        $posts = Post::select(DB::raw('DATE(created_at) as date'), DB::raw('CAST(count(*) AS UNSIGNED) as total'))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
        return view('admin.dashboard', ['posts' => $posts]);
    }
}
