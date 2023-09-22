@extends('components.layout')
@section('content')
<div class="flex justify-center mx-4 pb-5">
    <div class="flex flex-col items-center w-5/6 bg-neutral-700 rounded px-4 py-4">
        {{-- <div class="flex">
            <h3 class="text-lg">Select one of your items on the right to create swap offer or</h3>        
            <a href="{{route('create-listing-form')}}" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black ml-10">Create new listing</a>
        </div> --}}
            @php
                $imageA = $swap->itemA->images()->first();
                $imageB = $swap->itemB->images()->first();

            @endphp
            <div class="flex flex-wrap items-center mx-4 justify-center">
                <div class="flex flex-col w-full items-center md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                    <a href="{{route('show-listing', ['item' => $swap->itemA->id])}}">
                        <p class="font-bold mb-3">{{$swap->itemA->name}}</p>
                    </a>
                    <img src="{{$imageA ? asset('storage/' . $imageA->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                </div>
                
                <div class="flex flex-col justify-center w-full md:w-1/12 lg:w-1/12 sm:w-1/12 max-w-xs md:max-w-sm lg:max-w-md  mx-10 my-3">
                    <i class="fa-solid fa-right-left fa-3x"></i>                        
                </div>
                    <div class="flex flex-col w-full items-center md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                        <a href="{{route('show-listing', ['item' => $swap->itemB->id])}}">
                            <p class="font-bold mb-3">{{$swap->itemB->name}}</p>
                        </a>
                        <img src="{{$imageB ? asset('storage/' . $imageB->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                    </div>
                
            </div>
    </div>
</div>
@endsection