<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::with(['category', 'user'])->paginate(10);

        return view('home.home', compact('posts'));
    }
}
