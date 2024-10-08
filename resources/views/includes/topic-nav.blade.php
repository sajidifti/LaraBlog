<nav class="w-full py-4 border-t border-b bg-gray-100">
    <div class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div
            class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">

            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2" wire:navigate.hover>
                    {{ $category->name }}
                </a>
            @endforeach

        </div>
    </div>
</nav>
