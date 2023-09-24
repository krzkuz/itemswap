@extends('components.layout')
@section('content')
<div class="flex justify-center mx-4 pb-5">
    <div class="flex flex-col items-center w-5/6 bg-neutral-700 rounded px-4 py-4">
        <form action="{{route('create-listing-form')}}">
            @php
             session([
                'backLink' => route('swap-request', ['item' => $requestedItem->id])
             ])   
            @endphp
            <div class="flex">
                <h3 class="text-lg">Select one of your items on the right to create swap offer or</h3>        
                <button class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black ml-10">Create new listing</button>
            </div>
        </form>
        
        @php
            $image = $requestedItem->images()->first();
        @endphp

        <div class="flex space-between flex-wrap lg:flex-nowrap items-center">
            <div class="flex flex-col rounded my-3">
                <p class="font-bold mb-1">{{$requestedItem->name}}</p>
                <img src="{{$image ? asset('storage/' . $image->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
            </div>
            <div class="flex justify-center my-3 mx-10">
                <i class="fa-solid fa-right-left fa-3x"></i>                        
            </div>
            @if (count($userItems) != 0)
            <div class="flex flex-col">
            @foreach ($userItems as $item)
            <div class="flex justify-center">
                <form action="{{route('create-swap')}}" method="POST">
                    @csrf
                    <input type="text" name="offeredItemId" value="{{$item->id}}" hidden>
                    <input type="text" name="requestedItemId" value="{{$requestedItem->id}}" hidden>
                    <input type="text" name="requestedItemOwner" value="{{$requestedItem->owner->id}}" hidden>


                    @php
                        $image = $item->images()->first();
                    @endphp
                        <div class="flex justify-center items-center">
                            <div class="flex flex-col w-full items-center md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                                <p class="font-bold mb-1">{{$item->name}}</p>
                                <img src="{{$image ? asset('storage/' . $image->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                            </div>
                            <button type="submit" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black ml-4">Select</button>
                        </div>
                </form> 
            </div>

            @endforeach
            </div>                   

            @else
                <p class="text-md ">There are no items offers</p>
                <button class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black ml-10">Create new listing</button>
            @endif
        </div>

    </div>
</div>
@endsection