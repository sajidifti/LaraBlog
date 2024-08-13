@extends('layouts.app')
@section('title', 'Home')
@push('css')
@endpush
@section('topic-nav')
    @include('includes.topic-nav')
@endsection
@section('content')
    <section class="w-full md:w-2/3 flex flex-wrap items-center px-3 gap-4">

        @foreach ($posts as $post)
            <article class="w-full md:w-[calc(50%-1rem)] flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="{{ route('post.details', $post->slug) }}" class="hover:opacity-75">
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-auto">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="{{ route('category.show', $post->category->slug) }}"
                        class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</a>
                    <a href="{{ route('post.details', $post->slug) }}"
                        class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                    <p class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                        Published on {{ $post->created_at->format('M d, Y') }}
                    </p>
                    <a href="{{ route('post.details', $post->slug) }}" class="pb-6">{{ $post->description }}</a>
                    <a href="{{ route('post.details', $post->slug) }}"
                        class="uppercase text-gray-800 hover:text-black">Continue Reading
                        <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @endforeach



        <!-- Pagination -->
        <div class="flex items-center py-8">
            <a href="#"
                class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
            <a href="#"
                class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
            <a href="#"
                class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next
                <i class="fas fa-arrow-right ml-2"></i></a>
        </div>

    </section>



@endsection
@section('sidebar')
    @include('includes.sidebar')
@endsection
@push('js')
@endpush
