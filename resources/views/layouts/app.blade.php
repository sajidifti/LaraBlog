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

    <!-- toastr -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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



    {{-- <script>
        $(document).ready(function() {
            toastr.success('This is a success message!');
        });
    </script> --}}

    @stack('js')

</body>

</html>
