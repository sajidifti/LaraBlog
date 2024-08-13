@extends('layouts.app')
@section('title', 'Home')
@push('css')
@endpush
@section('topic-nav')
    @include('includes.topic-nav')
@endsection
@section('content')
    <section class="w-full md:w-2/3 flex flex-wrap items-center px-3 gap-4">
        <div id="posts-container" class="w-full flex flex-wrap items-center px-3 gap-4">
            {{-- Posts Will Be Loaded Here --}}
        </div>

        <!-- Load More -->
        <div class="w-full flex flex-col items-center">
            <div class="flex items-center py-8">
                <a id="load-more" href="#"
                    class="h-10 w-[15rem] bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">
                    Load More <i class="fas fa-redo ml-2"></i>
                </a>
            </div>
        </div>

    </section>

@endsection
@section('sidebar')
    @include('includes.sidebar')
@endsection
@push('js')
@endpush
