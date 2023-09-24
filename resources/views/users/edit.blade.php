@extends('components.layout')
@section('content')

<x-card>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Edit your profile
        </h2>
    </header>

    <form action="{{route('update-profile')}}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="first_name" class="inline-block text-lg mb-2"
                >First Name</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="first_name"
                value="{{$user->first_name ?? old('first_name')}}"
            />
            @error('first_name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="last_name" class="inline-block text-lg mb-2"
                >Last Name</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="last_name"
                value="{{$user->last_name ?? old('last_name')}}"
            />
            @error('last_name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="country" class="inline-block text-lg mb-2"
                >Country</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="country"
                value="{{$user->country ?? old('country')}}"
            />
            @error('country')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="city" class="inline-block text-lg mb-2"
                >City</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="city"
                value="{{$user->city ?? old('city')}}"
            />
            @error('city')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="address" class="inline-block text-lg mb-2"
                >Address</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="address"
                value="{{$user->address ?? old('address')}}"
            />
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2"
            >
                Save
            </button>
        </div>
    </form>
</x-card>
@endsection