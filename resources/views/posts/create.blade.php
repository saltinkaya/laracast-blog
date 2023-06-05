<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-sm mx-auto">
            <form action="/admin/posts" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="title">
                        Title
                    </label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="title" {{-- my request data will return under this name ["title"=> "asdasd" --}}
                           id="title"
                           value="{{old('title')}}"

                           required
                    >
                    @error("title")
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="excerpt">
                        Excerpt
                    </label>
                    <textarea class="border border-gray-400 p-2 w-full"
                              name="excerpt"
                              id="excerpt"
                              required
                    >{{old('excerpt')}}</textarea>
                    @error("excerpt")
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="body">
                        body
                    </label>
                    <textarea class="border border-gray-400 p-2 w-full"
                              name="body"
                              id="body"
                              required
                    >{{old('body')}}</textarea>
                    @error("body")
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">
                        Category
                    </label>
                    <select name="category_id" id="category">

                        @php
                            $categories = \App\Models\Category::all();

                        @endphp

                        @foreach($categories as $category)
                            <option value={{ $category->id }}> {{ ucwords($category->name) }}</option>
                        @endforeach

                        <option value="personal">Personal</option>
                    </select>
                    @error("category")
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <x-submit-button>
                    Create
                </x-submit-button>
            </form>
        </x-panel>

    </section>
</x-layout>
