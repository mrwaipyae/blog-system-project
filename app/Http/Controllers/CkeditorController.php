<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use illuminate\http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Post;

class CkeditorController extends Controller
{
    public function index(): View
    {
        return view('admin/ckeditor');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function upload(Request $request)
    // {
    //     dd($request);
    //     if ($request->hasFile('upload')) {
    //         $originName = $request->file('upload')->getClientOriginalName();
    //         $fileName = pathinfo($originName, PATHINFO_FILENAME);
    //         $extension = $request->file('upload')->getClientOriginalExtension();
    //         $fileName = $fileName . '_' . time() . '.' . $extension;

    //         $request->file('upload')->move(public_path('media'), $fileName);

    //         $url = asset('media/' . $fileName);

    //         return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    //     }
    // }

    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust the validation rules as needed
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $fileName);
            $post->image = $fileName;
        }

        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
}
