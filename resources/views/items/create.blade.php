@extends('components.layout')
@section('content')
{{-- <div class="flex flex-col bg-neutral-700 p-10 rounded max-w-lg mx-auto mt-24"> --}}
<x-card>
    <header class="flex flex-col text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create a Listing
        </h2>
        <p class="mb-4">Create a listing to swap items</p>
    </header>

    <form action="{{route('create-listing')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label for="name" class="inline-block text-lg mb-2">
                Listing Title</label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full flex"
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
                class="border border-gray-200 rounded p-2 w-full flex"
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
                class="border border-gray-200 rounded p-2 w-full flex"
                name="images[]"
                multiple
            />
            @error('images')
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
                class="border border-gray-200 rounded p-2 w-full flex"
                name="description"
                rows="10"
                placeholder="Include condition and other important details"
            >{{old('description')}}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <button class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">
                Create a listing
            </button>

            <a href="/" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2"> Back </a>
        </div>
    </form>
</x-card>
{{-- </div> --}}
@endsection