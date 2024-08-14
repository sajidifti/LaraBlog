<?php

namespace App\Http\Controllers;

use App\Models\FeaturedImage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function details(Post $post)
    {
        $nextPost = Post::where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->first();

        $previousPost = Post::where('id', '>', $post->id)
            ->orderBy('id', 'asc')
            ->first();

        $featuredImages = FeaturedImage::where('post_id', $post->id)->get();

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('post.details', [
            'post' => $post,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost,
            'featuredImages' => $featuredImages,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function getPostDetails($id)
    {
        $post = Post::with(['category', 'user'])->find($id);

        if ($post->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
        }

        return response()->json([
            'post' => $post,
            'category' => $post->category,
            'user' => $post->user,
        ]);
    }

    public function postStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:4096',
            'image_description' => 'required',
            'featured_images.*' => 'nullable|mimes:jpg,jpeg,png|max:4096',
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
            $post->summary = $request->summary;
            $post->user_id = Auth::id();

            $post->save();

            if ($request->hasFile('featured_images')) {
                foreach ($request->file('featured_images') as $featuredImage) {
                    $path = $featuredImage->store('featured_images', 'public');

                    $image = new FeaturedImage();
                    $image->post_id = $post->id;
                    $image->file_path = $path;
                    $image->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Post created successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }

    public function postUpdate(Request $request, Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:4096',
            'image_description' => 'required',
            'featured_images.*' => 'nullable|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['success' => false, 'errors' => $errors]);
        }

        try {
            $post->title = $request->title;
            $post->category_id = $request->category;
            if ($request->hasFile('image')) {
                $post->image = $request->file('image')->store('posts', 'public');
            }
            $post->image_description = $request->image_description;
            $post->description = $request->description;
            $post->summary = $request->summary;
            $post->user_id = Auth::id();

            $post->save();

            if ($request->hasFile('featured_images')) {
                foreach ($request->file('featured_images') as $featuredImage) {
                    $path = $featuredImage->store('featured_images', 'public');

                    $image = new FeaturedImage();
                    $image->post_id = $post->id;
                    $image->file_path = $path;
                    $image->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Post updated successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }

    public function postDelete($id)
    {
        $post = Post::find($id);

        if ($post->user_id != Auth::id()) {
            toastr()->error('You are not authorized to delete this post');
            return redirect()->route('home');
        }

        $post->delete();

        toastr()->success('Post deleted successfully');

        return redirect()->route('home');
    }

    public function imageUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('posts', 'public');

            $fileUrl = url('storage/' . $file);

            return response()->json(['location' => $fileUrl]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

}
