<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $posts = $user
            ->posts()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        // Calculate reading time for each post
        foreach ($posts as $post) {
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTimeMinutes = ceil($wordCount / 200); // Assuming an average reading speed of 200 words per minute
            $post->readingTime = $readingTimeMinutes;
        }

        // Calculate total likes received by the user
        $totalLikes = $user->likes->count();

        // total posts
        $totalPosts = $user->posts()->count();
        return view('profile', compact('user', 'totalPosts', 'posts', 'totalLikes'));
    }

    public function update(Request $request)
    {
        // Validation
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Update profile image if provided
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $imageName = time() . '_' . $profileImage->getClientOriginalName();
            $profileImage->storeAs('public/profile_images', $imageName);
            $user->profile_image = $imageName;
        }

        // Update name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()
            ->back()
            ->with('message', 'Profile updated successfully.');
    }
}
