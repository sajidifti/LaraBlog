@extends('layouts.app')
@section('title', $category->name)
@push('css')
@endpush
@section('topic-nav')
    @include('includes.topic-nav')
@endsection
@section('content')
    <section wire:ignore class="w-full md:w-2/3 flex flex-wrap items-center px-3 gap-4">
        <div id="posts-container" class="w-full flex flex-wrap items-center px-3 gap-4">
            {{-- Posts Will Be Loaded Here --}}
        </div>

        <!-- Load More -->
        <div class="w-full flex flex-col items-center">
            <div class="flex items-center py-8">
                <a id="load-more" href="javascript:void(0);"
                    class="h-10 w-[15rem] bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">
                    Load More <i class="fas fa-redo ml-2"></i>
                </a>
            </div>
        </div>

    </section>

@endsection
@section('sidebar')
    @guest
        @include('includes.login-sidebar')
    @endguest

    @auth
        @include('includes.profile-sidebar')
    @endauth
@endsection
@push('js')
    <script>
        var currentPage = 1;
        var loading = false;
        var totalPostCount = 0;

        console.log('Fetch Post Details in Show Category');

        function fetchPosts(page = 1) {
            if (loading) return;
            loading = true;

            $.ajax({
                url: '{{ route('category.posts.fetch', $category->id) }}',
                method: 'GET',
                data: {
                    page: page
                },
                success: function(response) {
                    if (response.posts.data.length === 0 && currentPage === 1) {
                        $('#posts-container').html('<p>No posts in this category. Create one.</p>');
                        $('#load-more').hide();
                        loading = false;
                        return;
                    } else if (response.posts.data.length === 0) {
                        $('#load-more').hide();
                        loading = false;
                        return;
                    }

                    if (currentPage === 1) {
                        totalPostCount = response.posts.total;

                        if (totalPostCount < 10) {
                            $('#load-more').hide();
                        }
                    }

                    var postsHtml = '';
                    response.posts.data.forEach(function(post) {
                        postsHtml += `
                                <article class="w-full md:w-[calc(50%-1rem)] flex flex-col shadow my-4">
                                    <a wire:navigate.hover href="/post/${post.slug}" class="hover:opacity-75">
                                        <img src="/storage/${post.image}" class="w-full h-auto">
                                    </a>
                                    <div class="bg-white flex flex-col justify-start p-6">
                                        <a wire:navigate.hover href="/category/${post.category.slug}"
                                            class="text-blue-700 text-sm font-bold uppercase pb-4">${post.category.name}</a>
                                        <a wire:navigate.hover href="/post/${post.slug}"
                                            class="text-3xl font-bold hover:text-gray-700 pb-4">${post.title.length > 20 ? post.title.slice(0, 20) + '...' : post.title}</a>
                                        <p class="text-sm pb-3">
                                            By <a href="#" class="font-semibold hover:text-gray-800">${post.user.name}</a>,
                                            Published on ${new Date(post.created_at).toLocaleDateString()}
                                        </p>
                                        <a wire:navigate.hover href="/post/${post.slug}"
                                            class="pb-6">${post.summary.length > 50 ? post.summary.slice(0, 50) + '...' : post.summary}
                                        </a>
                                        <a wire:navigate.hover href="/post/${post.slug}"
                                            class="uppercase text-gray-800 hover:text-black">Continue Reading
                                            <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </article>
                            `;
                    });

                    $('#posts-container').append(postsHtml);
                    currentPage++;
                    loading = false;
                }
            });
        }

        $(window).on('pageshow', function(event) {
            if (event.originalEvent.persisted) {
                $('#posts-container').empty();

                if (totalPostCount > 10) {
                    $('#load-more').show();
                }

                currentPage = 1;
                fetchPosts();
            }
        });

        fetchPosts();

        $('#load-more').on('click', function(e) {
            e.preventDefault();
            fetchPosts(currentPage);
        });
    </script>
@endpush
