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

    // public function likePost(Request $request, $id)
    // {
    //     $post = Post::findOrFail($id);
    //     $user = Auth::user();

    //     if ($post->likes()->where('user_id', $user->id)->exists()) {
    //         return redirect()->back()->with('error', 'You have already liked this post');
    //     }

    //     $like = new Like();
    //     $like->user_id = $user->id;
    //     $post->likes()->save($like);

    //     return redirect()->back()->with('success', 'Post liked successfully');
    // }

    public function likePost(Request $request, Post $post)
{
    $user = auth()->user();

    // check if user has already liked the post
    $existing_like = Like::all()->where('user_id', $user->id)->where('post_id', $post->id)->first();

    if (is_null($existing_like)) {
        // create new like
        $like = new Like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();
    } else {
        if (is_null($existing_like->deleted_at)) {
            // delete existing like
            $existing_like->delete();
        } else {
            // restore existing like
            $existing_like->restore();
        }
    }

    // return updated like count
    return response()->json([
        'likes_count' => $post->likes()->count(),
    ]);
}

}
