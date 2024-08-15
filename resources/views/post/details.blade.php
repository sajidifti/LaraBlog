@extends('layouts.app')
@section('title', $post->title)
@push('css')
@endpush
@section('topic-nav')
    @include('includes.topic-nav')
@endsection
@section('content')
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" id="post-image-link" class="hover:opacity-75">
                <img src="{{ asset('storage/' . $post->image) }}" class="featured-images" id="post-image">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('category.show', $post->category->slug) }}" id="post-category-link"
                    class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</a>
                <a href="#" id="post-title-link"
                    class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                <p id="post-author-info" class="text-sm pb-8">
                    By <a href="#" id="post-author-link"
                        class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on
                    {{ $post->created_at->format('M d, Y') }}
                </p>

                <div id="post-summary" class="pb-10 font-bold">
                    {{ $post->summary }}
                </div>

                <div id="post-description">
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
                            class="fas fa-arrow-right pl-1"></i>
                    </p>
                    <p class="pt-2">No Next Post</p>
                </div>
            @endif
        </div>


        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
            <!-- Profile Photo -->
            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4 md:pb-0 md:mr-6">
                <img src="{{ asset('storage/' . $post->user->profile_photo) }}"
                    class="rounded-full shadow h-32 w-32 object-cover">
            </div>
            <!-- User Info -->
            <div class="flex-1 flex flex-col justify-center md:justify-start">
                <p class="font-semibold text-2xl">{{ $post->user->name }}</p>
                <p class="pt-2 text-gray-600">{{ $post->user->email }}</p>
                <div class="flex items-center justify-center md:justify-start text-2xl text-blue-800 pt-4 space-x-4">
                    <a href="#" class="hover:text-blue-600">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="hover:text-pink-600">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="hover:text-blue-700">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('sidebar')
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        @auth
            @if (auth()->user()->id == $post->user_id)
                <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                    <button
                        class="w-full bg-blue-800 hover:bg-blue-600 text-white font-semibold p-2 flex items-center justify-center"
                        data-twe-toggle="modal" data-twe-target="#editModal" data-twe-ripple-init data-twe-ripple-color="light">
                        Edit Post
                    </button>
                    <a href="{{ route('post.delete', $post->id) }}"
                        class="w-full mt-4 bg-red-600 hover:bg-red-500 text-white font-semibold p-2 flex items-center justify-center"
                        onclick="confirmation(event)">
                        Delete Post
                    </a>
                </div>

                @include('includes.edit-modal', ['post' => $post])
            @endif
        @endauth


        @if ($featuredImages->count() > 0)
            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Featured Images</p>
                <div class="grid grid-cols-3 gap-3">
                    @foreach ($featuredImages as $image)
                        <img class="hover:opacity-75 cursor-pointer featured-images"
                            src="{{ asset('storage/' . $image->file_path) }}">
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
                        <p class="pt-2 text-gray-600">{{ \Illuminate\Support\Str::limit($relatedPost->summary, 80) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="popup-image"
            style="position: fixed; top: 0; left: 0; background: rgba(0, 0, 0, 0.7); z-index: 100; width: 100%; height: 100%; display: none; opacity: 0; transition: opacity 0.3s ease;">
            <span
                style="position: absolute; top: 10px; right: 10px; color: #fff; font-size: 50px; cursor: pointer; z-index: 100;">&times;</span>
            <img style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 2px solid #fff; max-width: 90%; max-height: 90vh; object-fit: contain; transition: transform 0.3s ease;"
                src="" alt="">
        </div>

    </aside>

@endsection
@push('js')
    <script>
        function confirmation(event) {
            event.preventDefault();

            var urlToRedirect = event.target.getAttribute('href');

            swal({
                title: "Are you sure you want to delete this post?",
                text: "Once deleted, you will not be able to recover this.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            })
        }
    </script>

    <script>
        document.querySelectorAll('.featured-images').forEach(image => {
            image.onclick = () => {
                const popup = document.querySelector('.popup-image');
                popup.style.display = 'block';
                setTimeout(() => {
                    popup.style.opacity = '1';
                }, 10);
                popup.querySelector('img').src = image.getAttribute('src');
            }
        });

        document.querySelector('.popup-image span').onclick = () => {
            const popup = document.querySelector('.popup-image');
            popup.style.opacity = '0';
            setTimeout(() => {
                popup.style.display = 'none';
            }, 300);
        }
    </script>

    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            formats: {
                h1: {
                    block: 'h1',
                    classes: 'text-3xl'
                }
            },
            plugins: 'image code',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
            images_upload_url: '{{ route('post.image.upload') }}',
            automatic_uploads: true,
        });

        console.log('Tinymce Editor Initialized');
    </script>
@endpush
