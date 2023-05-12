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

        // Return the HTML for the new comment as a JSON response
        $result = [
            'comment' => $comment->content,
            'user' => $user,
            'profile' => $profile,
            'date' => $date
        ];
        return response()->json(['result' => $result]);
    }
