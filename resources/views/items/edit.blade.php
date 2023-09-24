@props(['item'])

@extends('components.layout')
@section('content')
<x-card>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Edit your Listing
        </h2>
        {{-- <p class="mb-4">Create a listing to swap items</p> --}}
    </header>

    @php
        $firstIteration = true;
    @endphp

    <div class="mb-6">
        <label for="image" class="inline-block text-lg mb-2">
            Pictures of the item
        </label>
        @foreach ($images as $image)
            <div class="flex items-center">
                <img
                class="w-20 mx-5 my-2 rounded-md"
                src="{{$image ? asset($image->cropped_image_path):
                asset('images/no-image.png')}}"
                alt=""
                />
                <form action="{{route('delete-picture', $image->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-black text-gray-400 text-xs py-2 px-2 mr-3 rounded-lg hover:text-white hover:bg-gray-900">Delete Picture</button>
                </form>
                @if (!$firstIteration)
                    <form action="{{route('main-picture', $image->id)}}" method="POST">
                        @csrf
                        <button class="bg-black text-gray-400 text-xs py-2 px-2 rounded-lg hover:text-white hover:bg-gray-900">Set as main picture</button>
                    </form>
                @endif
            </div>
            
            @php
                $firstIteration = false;
            @endphp
        @endforeach
    </div>

    <form action="{{route('update-listing', ['item' => $item->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label for="name" class="inline-block text-lg mb-2">
                Listing Title</label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name"
                placeholder="Example: Book to swap"
                value="{{$item->name}}"
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
                value="{{$tags}}"
            />
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <label for="image" class="inline-block text-lg mb-2">
                Add pictures
            </label>

            <input
                type="file"
                class="border border-gray-200 rounded p-2 w-full"
                name="images[]"
                value="{{$item->images}}"
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
                placeholder="Include tasks, requirements, salary, etc"
            >{{$item->description}}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <button class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">
                Update a lisitng
            </button>

            <a href="{{route('home')}}" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2"> Back </a>
        </div>
    </form>
</x-card>
@endsection