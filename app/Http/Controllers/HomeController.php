<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.home');
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
