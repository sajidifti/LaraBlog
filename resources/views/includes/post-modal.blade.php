<!-- Modal -->
<div data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="postModal"
    tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[0px]:m-0 min-[0px]:h-full min-[0px]:max-w-none">
        <div
            class="pointer-events-auto relative flex w-full flex-col rounded-md bg-white bg-clip-padding text-current shadow-4 outline-none dark:bg-surface-dark min-[0px]:h-full min-[0px]:rounded-none min-[0px]:border-0">
            <div
                class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4 dark:border-white/10 min-[0px]:rounded-none">
                <!-- Modal title -->
                <h5 class="text-xl font-medium leading-normal text-surface dark:text-white" id="postModalLabel">
                    Post Your Thoughts...
                </h5>
                <!-- Close button -->
                <button type="button"
                    class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                    data-twe-modal-dismiss aria-label="Close">
                    <span class="[&>svg]:h-6 [&>svg]:w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>
            <form class="relative p-4 min-[0px]:overflow-y-auto" id="postForm" method="POST"
                action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Modal body -->
                <div class="relative p-4 min-[0px]:overflow-y-auto">

                    <div class="mb-5">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
                        <select id="category" name="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="base-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" id="base-input" name="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div class="mb-5">
                        <label for="summary"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Summary</label>
                        <textarea id="summary" rows="3" name="summary"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Leave a comment..."></textarea>
                    </div>

                    <div class="mb-5">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="4" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Leave a comment..."></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Upload Main Image</label>
                        <input name="image"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image_help" id="image" type="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">Choose an
                            appropriate image for your post.</div>
                    </div>

                    <div class="mb-5">
                        <label for="image_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image
                            Description</label>
                        <input type="text" id="image_description" name="image_description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <h1 class="text-3xl">Featured Images</h1>
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="featured_image">Upload Image</label>
                        <div id="file-input-container">
                            <div class="file-input-wrapper mb-2">
                                <input name="featured_images[]"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="featured_image_help" type="file">
                            </div>
                        </div>
                        <button type="button" id="add-file-input"
                            class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                            Add More Files
                        </button>
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="featured_image_help">Upload
                            Images
                            for the Carousel Section. You can add as many as you want.</div>
                    </div>


                </div>

                <!-- Modal footer -->
                <div
                    class="mt-auto flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4 dark:border-white/10 min-[0px]:rounded-none">

                    <button type="submit" id="submit-btn"
                        class="inline-block mr-5 rounded bg-blue-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400">
                        POST
                    </button>

                    <button type="button" id="cancel-btn"
                        class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                        data-twe-modal-dismiss>
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-file-input').addEventListener('click', function() {
        var newFileInput = document.createElement('div');
        newFileInput.classList.add('file-input-wrapper', 'mb-2');
        newFileInput.innerHTML = `
            <input name="featured_images[]"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                aria-describedby="featured_image_help" type="file">
        `;

        document.getElementById('file-input-container').appendChild(newFileInput);
    });
</script>

<script type="text/javascript">
    @if (Route::currentRouteName() == 'home')
        var currentPage = 1;
        var loading = false;

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
                                    class="text-3xl font-bold hover:text-gray-700 pb-4">${post.title}</a>
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

        fetchPosts();

        $('#load-more').on('click', function(e) {
            e.preventDefault();
            fetchPosts(currentPage);
        });
    @endif

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#postForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,

            success: function(response) {
                console.log(response);

                if (response.success) {
                    toastr.success(response.message);

                    setTimeout(function() {
                        $('#postForm')[0].reset();
                        $('#cancel-btn').click();

                        @if (Route::currentRouteName() == 'home')
                            $('#posts-container').empty();
                            currentPage = 1;
                            loading = false;

                            fetchPosts();
                        @endif
                    }, 2000);
                } else {
                    $.each(response.errors, function(key, value) {
                        toastr.error(value);
                    });
                }
            },

            error: function(xhr) {
                console.log(xhr);

                if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.error('Internal Server Error. Please try again later.');
                }
            }
        });
    });
</script>
