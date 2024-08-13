<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.home');
    }

    public function fetchPosts(Request $request)
    {
        $page = $request->input('page', 1);

        if (Auth::check()) {
            $posts = Post::with(['category', 'user'])->where('user_id', Auth::user()->id)->latest()->paginate(10, ['*'], 'page', $page);
        } else {
            $posts = Post::with(['category', 'user'])->latest()->paginate(10, ['*'], 'page', $page);
        }

        return response()->json([
            'posts' => $posts,
        ]);
    }

}
