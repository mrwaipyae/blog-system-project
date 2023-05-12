<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where(function ($q) use ($query) {
            $q->where('title', 'like', '%'.$query.'%')
              ->orWhere('content', 'like', '%'.$query.'%');
        })
        ->orWhereHas('tags', function ($q) use ($query) {
            $q->where('name', 'like', '%'.$query.'%');
        })
        ->orWhereHas('user', function ($q) use ($query) {
            $q->where('name', 'like', '%'.$query.'%');
        })
        ->get();
        $users = User::where('name', 'like', '%'.$query.'%')->get();
        $tags = Tag::where('name', 'like', '%'.$query.'%')->get();
        if ($request->ajax()) {
            $data = [
                'posts' => $posts,
                'users' => $users,
                'tags' => $tags
            ];
            return response()->json($data);
        }
        return view('search', compact('posts', 'users', 'tags', 'query'));
    }
}
