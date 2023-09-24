@extends('components.layout')
@section('content')
<div class="flex justify-center mx-4 pb-5">
    <div class="flex flex-col items-center w-5/6 bg-neutral-700 rounded px-4 py-4">
            @php
                $imageA = $swap->itemA->images()->first();
                $imageB = $swap->itemB->images()->first();
                $userId = auth()->id();

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
                <div>
                    @if($swap->owner_a == $userId)
                        @if ($swap->is_confirmed)
                            <p class="font-medium mb-3">Swap confirmed</p>
                            <p class="font-medium mb-3">User's address: {{$swap->ownerA->country}} {{$swap->ownerA->city}} {{$swap->ownerA->address}}</p>                        
                        @else
                            <a href="{{route('confirm-swap', ['swap' => $swap->id])}}" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black ml-10">Accept Request</a>
                        @endif

                    @else
                        @if ($swap->is_confirmed)
                            <p class="font-medium mb-3">User {{$swap->ownerA->first_name}} {{$swap->ownerA->last_name}} has confirmed your swap request</p>
                            <p class="font-medium mb-3">User's address: {{$swap->ownerA->country}} {{$swap->ownerA->city}} {{$swap->ownerA->address}}</p>                        
                        @else
                            <p class="font-medium mb-3">User {{$swap->ownerA->first_name}} {{$swap->ownerA->last_name}} has not confirmed your swap request yet</p>
                        @endif
                    @endif
                </div>
                
            </div>
    </div>
</div>
@endsection