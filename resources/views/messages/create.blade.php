@extends('components.layout')
@section('content')
<div class="bg-gray-700 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Send a message
        </h2>
    </header>

    <form action="{{route('send-message')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="itemId" value="{{$itemId}}" hidden>
        <input type="text" name="recipientId" value="{{$recipientId}}" hidden>

        <div class="mb-6">
            <label
                for="body"
                class="inline-block text-lg mb-2">
                Message body
            </label>
            <textarea
                class="border border-gray-200 rounded p-2 w-full"
                name="body"
                rows="10"
                value="{{old('body')}}"
            ></textarea>
            @error('body')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>                
            @enderror
        </div>

        <div class="mb-6">
            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                Send message
            </button>

            <a href="/" class="text-black ml-4"> Back </a>
        </div>
    </form>
</div>
@endsection