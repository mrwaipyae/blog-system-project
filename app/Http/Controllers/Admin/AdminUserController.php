<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
        
        return view('admin/users/index',['users'=>User::all()]);
    }

    public function view(Request $request){
        $userId = $request->id;
        $user = User::find( $userId);
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        $totalPosts = $user->posts()->count();
        return view('admin/users/view', compact('user', 'totalPosts', 'userPosts',));
    }
}
