@extends('layouts.app')
@section('title', 'Login')
@push('css')
@endpush
@section('content')
    <!-- component -->
    <div class="py-6 flex flex-col justify-center sm:py-12 mx-auto">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold">Login To Your Account</h1>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                        Address</label>
                                    <input autocomplete="off" id="email" name="email" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Email address" value="{{ old('email') }}" />
                                </div>
                                <div class="relative">
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input autocomplete="off" id="password" name="password" type="password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Password" />
                                </div>
                                <div class="relative">
                                    <button type="submit"
                                        class="w-full bg-blue-500 text-white rounded-md px-2 py-1 hover:bg-blue-600 transition">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
