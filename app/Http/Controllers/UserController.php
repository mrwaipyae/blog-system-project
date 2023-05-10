<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showPosts($user,$id){
        $user = User::find( $id );
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        $totalPosts = $user->posts()->count();
        return view('user.posts', compact('user', 'totalPosts', 'userPosts',));
    }
}
