<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'content' => 'required',
    //         'post_id' => 'required|exists:posts,id',
    //     ]);

    //     $comment = new Comment;
    //     $comment->content = $request->input('content');
    //     $comment->post_id = $request->input('post_id');
    //     $comment->user_id = Auth::id();
    //     $comment->save();

    //     return redirect()->back()->with('success', 'Comment added successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = Auth::id();
        $comment->save();
        $post = Post::findOrFail($request->input('post_id'));
        $user = $comment->user->name;
        $profile = $comment->user->profile_image;
        $date = date("F j", strtotime($comment->created_at));
        $count = $post->comments()->count();
        
        // Return the HTML for the new comment as a JSON response
        $result = [
            'id' => $comment->id,
            'comment' => $comment->content,
            'user' => $user,
            'profile' => $profile,
            'date' => $date,
            'count'=>$count
        ];
        return response()->json(['result' => $result]);
    }

    public function edit(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->content = $request->comment;
        $comment->save();
        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->forceDelete();
        return redirect()->back();
    }
}
