<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LaraBlog') | LaraBlog</title>
    <meta name="author" content="Sajid Anam Ifti">
    <meta name="description" content="">

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    @stack('css')

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- TinyMCE -->
    {{-- Add your TinyMCE API key --}}
    @include('includes.tinymce')


    <script>
        @if (Route::currentRouteName() == 'home')
            var currentPage = 1;
            var loading = false;
            var totalPostCount = 0;

            function fetchPosts(page = 1) {
                if (loading) return;
                loading = true;

                $.ajax({
                    url: '{{ route('posts.fetch') }}',
                    method: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        if (response.posts.data.length === 0 && currentPage === 1) {
                            $('#posts-container').html('<p>You have no posts. Create one.</p>');
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
                                    <a href="/post/${post.slug}" class="hover:opacity-75">
                                        <img src="/storage/${post.image}" class="w-full h-auto">
                                    </a>
                                    <div class="bg-white flex flex-col justify-start p-6">
                                        <a href="/categories/${post.category.slug}"
                                            class="text-blue-700 text-sm font-bold uppercase pb-4">${post.category.name}</a>
                                        <a href="/post/${post.slug}"
                                            class="text-3xl font-bold hover:text-gray-700 pb-4">${post.title.length > 20 ? post.title.slice(0, 20) + '...' : post.title}</a>
                                        <p class="text-sm pb-3">
                                            By <a href="#" class="font-semibold hover:text-gray-800">${post.user.name}</a>,
                                            Published on ${new Date(post.created_at).toLocaleDateString()}
                                        </p>
                                        <a href="/post/${post.slug}"
                                            class="pb-6">${post.summary.length > 50 ? post.summary.slice(0, 50) + '...' : post.summary}
                                        </a>
                                        <a href="/post/${post.slug}"
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
        @endif
    </script>

</head>

<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    @include('includes.top-navbar')

    <!-- Text Header -->
    @include('includes.header')

    <!-- Topic Nav -->
    @yield('topic-nav')


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        @yield('content')

        <!-- Sidebar Section -->
        @yield('sidebar')

    </div>

    <!-- Footer -->
    @include('includes.footer')

    @auth
        @include('includes.post-modal')
    @endauth

    <!-- Scripts -->

    @auth
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
        </script>
    @endauth

    @stack('js')

</body>

</html>
