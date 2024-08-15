<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a href="{{ route('home') }}" wire:navigate.hover>
            <img
                src="{{ asset('assets/logo_blue.png') }}"
                alt="Logo"
                class="h-auto w-36"
            />
        </a>
        <p class="text-lg text-gray-600 mt-4">
            Your All-In-One Blogging Platform
        </p>
    </div>
</header>

