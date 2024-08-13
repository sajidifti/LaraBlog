@extends('layouts.app')
@section('title', 'Home')
@push('css')
@endpush
@section('topic-nav')
    @include('includes.topic-nav')
@endsection
@section('content')
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75">
                <img src="{{ asset('storage/' . $post->image) }}">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('category.show', $post->category->slug) }}"
                    class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</a>
                <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                <p href="#" class="text-sm pb-8">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on
                    {{ $post->created_at->format('M d, Y') }}
                </p>

                <div class="pb-10 font-bold">
                    {{ $post->summary }}
                </div>

                <div>
                    {!! $post->description !!}
                </div>

            </div>
        </article>

        <div class="w-full flex pt-6">
            @if ($previousPost)
                <a href="{{ route('post.details', $previousPost->slug) }}"
                    class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i>
                        Previous
                    </p>
                    <p class="pt-2">{{ \Illuminate\Support\Str::limit($previousPost->title, 20) }}</p>
                </a>
            @else
                <div class="w-1/2 bg-white shadow text-left p-6 opacity-50">
                    <p class="text-lg text-gray-400 flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous
                    </p>
                    <p class="pt-2">No Previous Post</p>
                </div>
            @endif

            @if ($nextPost)
                <a href="{{ route('post.details', $nextPost->slug) }}"
                    class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i
                            class="fas fa-arrow-right pl-1"></i></p>
                    <p class="pt-2">{{ \Illuminate\Support\Str::limit($nextPost->title, 20) }}</p>
                </a>
            @else
                <div class="w-1/2 bg-white shadow text-right p-6 opacity-50">
                    <p class="text-lg text-gray-400 flex items-center justify-end">Next <i
                            class="fas fa-arrow-right pl-1"></i></p>
                    <p class="pt-2">No Next Post</p>
                </div>
            @endif
        </div>


        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                <img src="{{ asset('storage/' . $post->user->profile_photo) }}" class="rounded-full shadow h-32 w-32">
            </div>
            <div class="flex-1 flex flex-col justify-center md:justify-start">
                <p class="font-semibold text-2xl">{{ $post->user->name }}</p>
                <p class="pt-2">{{ $post->user->email }}</p>
                <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                    <a class="" href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('sidebar')
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        @if (auth()->user()->id == $post->user_id)
            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <a href="{{ route('post.details', $post->slug) }}"
                    class="w-full bg-blue-800 hover:bg-blue-600 text-white font-semibold p-2 flex items-center justify-center">
                    Edit Post
                </a>
                <a href="{{ route('post.details', $post->slug) }}"
                    class="w-full mt-2 bg-red-600 hover:bg-red-500 text-white font-semibold p-2 flex items-center justify-center">
                    Delete Post
                </a>
            </div>
        @endif


        @if ($featuredImages->count() > 0)
            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Featured Images</p>
                <div class="grid grid-cols-3 gap-3">
                    @foreach ($featuredImages as $image)
                        <img class="hover:opacity-75 cursor-pointer" src="{{ asset('storage/' . $image->file_path) }}">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">Related Posts</p>

            @foreach ($relatedPosts as $relatedPost)
                <a href="{{ route('post.details', $relatedPost->slug) }}"
                    class="w-full flex flex-col md:flex-row shadow bg-white mt-10 mb-10 no-underline hover:shadow-lg transition-shadow duration-300">
                    <div class="w-full md:w-1/5 flex justify-center items-center overflow-hidden">
                        <img src="{{ asset('storage/' . $relatedPost->image) }}"
                            class="object-cover h-32 w-full md:w-auto md:h-full">
                    </div>
                    <div class="flex-1 flex flex-col justify-center md:justify-start px-4">
                        <p class="font-semibold text-xl">{{ \Illuminate\Support\Str::limit($relatedPost->title, 20) }}</p>
                        <p class="pt-2 text-gray-600">{{ $relatedPost->user->email }}</p>
                    </div>
                </a>
            @endforeach
        </div>

    </aside>

@endsection
@push('js')
@endpush
