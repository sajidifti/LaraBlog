@extends('layouts.app')
@section('title', 'Home')
@push('css')
@endpush
@section('topic-nav')
    @include('includes.topic-nav')
@endsection
@section('content')

    <div class="w-full flex flex-wrap gap-4">
        <div class="w-full md:w-[calc(50%-1rem)] flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold">Categories</h1>
                <button
                    class="bg-blue-800 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded-md shadow-sm transition duration-300 ease-in-out w-24 text-center"
                    data-twe-toggle="modal" data-twe-target="#categoryEditModal" data-twe-ripple-init
                    data-twe-ripple-color="light">
                    Add
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="py-2 px-4 text-left text-gray-600">SL</th>
                            <th class="py-2 px-4 text-left text-gray-600">Name</th>
                            <th class="py-2 px-4 text-left text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $category->name }}</td>
                                <td class="py-2 px-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="bg-blue-800 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded-md shadow-sm transition duration-300 ease-in-out w-24 text-center"
                                            data-twe-toggle="modal" data-twe-target="#categoryEditModal"
                                            data-twe-ripple-init data-twe-ripple-color="light">
                                            Edit
                                        </button>
                                        <a href="#"
                                            class="bg-red-600 hover:bg-red-500 text-white font-semibold py-1 px-4 rounded-md shadow-sm transition duration-300 ease-in-out w-24 text-center"
                                            onclick="confirmation(event)">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-full md:w-[calc(50%-1rem)] flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-center">Users</h1>
                <button
                    class="bg-blue-800 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded-md shadow-sm transition duration-300 ease-in-out w-24 text-center"
                    data-twe-toggle="modal" data-twe-target="#categoryEditModal" data-twe-ripple-init
                    data-twe-ripple-color="light">
                    Add
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="py-2 px-4 text-left text-gray-600">SL</th>
                            <th class="py-2 px-4 text-left text-gray-600">Name</th>
                            <th class="py-2 px-4 text-left text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">
                                    <div class="flex space-x-2">
                                        <button
                                            class="bg-blue-800 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded-md shadow-sm transition duration-300 ease-in-out w-24 text-center"
                                            data-twe-toggle="modal" data-twe-target="#userEditModal"
                                            data-twe-ripple-init data-twe-ripple-color="light">
                                            Edit
                                        </button>
                                        <a href="#"
                                            class="bg-red-600 hover:bg-red-500 text-white font-semibold py-1 px-4 rounded-md shadow-sm transition duration-300 ease-in-out w-24 text-center"
                                            onclick="confirmation(event)">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
@push('js')
@endpush
