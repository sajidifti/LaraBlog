<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // dd($category);
        return view('categories.show', compact('category'));
    }

    public function fetchPosts(Request $request, $id)
    {
        $page = $request->input('page', 1);

        if (Auth::check()) {
            $posts = Post::with(['category', 'user'])->where('category_id', $id)->where('user_id', Auth::user()->id)->latest()->paginate(10, ['*'], 'page', $page);
        } else {
            $posts = Post::with(['category', 'user'])->where('category_id', $id)->latest()->paginate(10, ['*'], 'page', $page);
        }

        return response()->json([
            'posts' => $posts,
        ]);
    }
}
