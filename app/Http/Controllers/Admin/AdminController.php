<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        $postsPerMonth = DB::table('posts')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();


        // Pass the $postsPerMonth data to the view and display it on the chart
        return view('admin.dashboard', ['postsPerMonth' => $postsPerMonth]);
    }
}
