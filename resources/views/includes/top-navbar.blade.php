<nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

        <nav>
            <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">

                @guest
                    {{-- Only visible to guests (unauthenticated users) --}}
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('login') }}">Login</a></li>
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('register') }}">Register</a></li>
                @endguest

                @auth
                    {{-- Only Visible to logged-in users --}}
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="hover:text-gray-200 hover:underline px-4">LOGOUT</button>
                        </form>
                    </li>

                    <li><button class="hover:text-gray-200 hover:underline px-4" data-twe-toggle="modal"
                            data-twe-target="#postModal" data-twe-ripple-init data-twe-ripple-color="light">POST</button>
                    </li>

                    @if (auth()->user()->user_type === 'admin')
                        {{-- Only visible to admins --}}
                        <li><a class="hover:text-gray-200 hover:underline px-4"
                                href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif
                @endauth

            </ul>
        </nav>

        <div class="flex items-center text-lg no-underline text-white pr-6 h-10">
            @auth
                <a href="#">
                    <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80"
                        alt="Profile Picture" class="rounded-full w-10 h-10" />
                </a>
            @endauth
        </div>

    </div>

</nav>
