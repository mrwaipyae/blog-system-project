<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function likePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already liked this post');
        }

        $like = new Like();
        $like->user_id = $user->id;
        $post->likes()->save($like);

        return redirect()->back()->with('success', 'Post liked successfully');
    }
}
