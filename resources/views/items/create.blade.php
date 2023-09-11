@extends('components.layout')
@section('content')
<div class="bg-gray-700 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create a Listing
        </h2>
        <p class="mb-4">Create a listing to swap items</p>
    </header>

    <form action="/items" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label for="name" class="inline-block text-lg mb-2">
                Listing Title</label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name"
                placeholder="Example: Book to swap"
                value="{{old('name')}}"
            />
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <label for="tags" class="inline-block text-lg mb-2">
                Tags (Comma Separated)
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="tags"
                placeholder="Example: clothing, good condition"
                value="{{old('tags')}}"
            />
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <label for="image" class="inline-block text-lg mb-2">
                Pictures of the item
            </label>
            <input
                type="file"
                class="border border-gray-200 rounded p-2 w-full"
                name="images[]"
                multiple
            />
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="description"
                class="inline-block text-lg mb-2">
                Item Description
            </label>
            <textarea
                class="border border-gray-200 rounded p-2 w-full"
                name="description"
                rows="10"
                placeholder="Include condition and other important details"
                value="{{old('description')}}"
            ></textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                Create a lisitng
            </button>

            <a href="/" class="text-black ml-4"> Back </a>
        </div>
    </form>
</div>
@endsection