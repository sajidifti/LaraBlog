<aside class="w-full md:w-1/3 flex flex-col items-center px-3">

    <div class="w-full bg-white shadow flex flex-col my-4 p-6 sticky top-5">
        <p class="text-xl font-semibold pb-5">LaraBlog</p>
        <p class="pb-2">LaraBlog is a simple blog system written with Laravel. It features a clean and minimal design.
        </p>
        <a href="{{ route('login') }}"
            class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4" wire:navigate.hover>
            Login
        </a>
        <a href="{{ route('register') }}"
            class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4" wire:navigate.hover>
            Register
        </a>
    </div>

</aside>
