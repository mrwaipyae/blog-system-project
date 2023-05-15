<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user = User::find( $user->id );
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        $totalPosts = $user->posts()->count();
        return view('profile', compact('user', 'totalPosts', 'userPosts',));
    }
}
