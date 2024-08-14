<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();

        return view('admin.dashboard', compact('users'));
    }

    public function allPosts()
    {
        return view('admin.all-posts');
    }

    public function fetchPosts(Request $request)
    {
        $page = $request->input('page', 1);

        $posts = Post::with(['category', 'user'])->latest()->paginate(10, ['*'], 'page', $page);

        return response()->json([
            'posts' => $posts,
        ]);
    }
}
