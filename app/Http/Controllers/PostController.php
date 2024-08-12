<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function details(Post $post)
    {
        return view('post.details', ['post' => $post]);
    }

    public function postStore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'category' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png|max:4096',
        'image_description' => 'required',
        'description' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        return response()->json(['success' => false, 'errors' => $errors]);
    }

    try {
        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->image = $request->file('image')->store('posts', 'public');
        $post->image_description = $request->image_description;
        $post->description = $request->description;
        $post->user_id = Auth::id();

        $post->save();

        return response()->json(['success' => true, 'message' => 'Post created successfully']);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'errors' => [$e->getMessage()],
        ], 500);
    }
}


}
