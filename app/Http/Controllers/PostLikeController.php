<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class PostLikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $user = Auth::user();

        // Check if the user has already liked the post
        $like = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if ($like) {
            // Unlike the post
            $like->delete();
        } else {
            // Like the post
            $like = new Like(['user_id' => $user->id, 'post_id' => $post->id]);
            $like->save();
        }

        // Return the updated like count
        $likesCount = $post->likes()->count();
        return response()->json(['likes_count' => $likesCount]);
    }

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
