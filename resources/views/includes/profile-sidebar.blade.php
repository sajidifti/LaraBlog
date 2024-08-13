<aside class="w-full md:w-1/3 flex flex-col items-center px-3">

    <div class="w-full bg-white shadow flex flex-col my-4 p-6 sticky top-5">
        <!-- Profile Photo -->
        <div class="w-full flex justify-center pb-4">
            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                class="rounded-full shadow h-32 w-32 object-cover">
        </div>
        <!-- User Info -->
        <div class="flex-1 flex flex-col items-center text-center md:text-left">
            <p class="font-semibold text-2xl">{{ auth()->user()->name }}</p>
            <p class="pt-2 text-gray-600">{{ auth()->user()->email }}</p>
            <!-- Social Media Links -->
            <div class="flex items-center justify-center md:justify-start text-2xl text-blue-800 pt-4 space-x-4">
                <a href="#" class="hover:text-blue-600">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="hover:text-pink-600">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="hover:text-blue-400">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="hover:text-blue-700">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
    </div>

</aside>
