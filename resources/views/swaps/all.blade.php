@extends('components.layout')
@section('content')
<div class="flex justify-center">
    <div class="flex justify-center mt-10 w-5/6 h-4/6">
        <div class="flex flex-col items-center w-full bg-neutral-700 rounded px-4 py-4 max-w-[50%]">
            <h3 class="font-bold text-lg">Swap offers sent</h3>
            @if (count($swapsSent) != 0)
                @foreach ($swapsSent as $swap)
                    @php
                        $imageA = $swap->itemA->images()->first();
                        $imageB = $swap->itemB->images()->first();

                    @endphp
                    <div class="flex flex-wrap items-center mx-4 my-4 justify-between border-b border-neutral-400">
                        <div class="w-full md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                            <img src="{{$imageA ? asset('storage/' . $imageA->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                        </div>
                        <div class="flex justify-center w-full md:w-1/12 lg:w-1/12 sm:w-1/12 max-w-xs md:max-w-sm lg:max-w-md  mx-10 my-3">
                            <i class="fa-solid fa-right-left fa-3x"></i>                        
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                            <img src="{{$imageB ? asset('storage/' . $imageB->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                        </div>
                    </div>
                @endforeach               
            @else
                <p class="text-md mt-10">There are no offers</p>
            @endif
        </div>
        <div class="w-5"></div>
        <div class="flex flex-col items-center w-full bg-neutral-700 rounded px-4 py-4 max-w-[50%]">
            <h3 class="font-bold text-lg">Swap offers received</h3>
            @if (count($swapsReceived) != 0)
                @foreach ($swapsReceived as $swap)
                    @php
                        $imageA = $swap->itemA->images()->first();
                        $imageB = $swap->itemB->images()->first();
                    @endphp
                    <a href="{{route('show-swap', ['swap' => $swap->id])}}" class="my-4">
                        <div class="flex flex-wrap items-center mx-4 justify-between border-b border-neutral-400">
                            <div class="flex flex-col w-full items-center md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                                <p class="font-bold mb-1">{{$swap->itemA->name}}</p>
                                <img src="{{$imageA ? asset('storage/' . $imageA->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                            </div>
                            <div class="flex flex-col justify-center w-full md:w-1/12 lg:w-1/12 sm:w-1/12 max-w-xs md:max-w-sm lg:max-w-md  mx-10 my-3">
                                <i class="fa-solid fa-right-left fa-3x"></i>                        
                            </div>
                            <div class="flex flex-col w-full items-center w-full md:w-1/2 lg:w-1/3 sm:w-1/2 xs:w-1/2 max-w-xs md:max-w-sm lg:max-w-md rounded my-3">
                                <p class="font-bold mb-1">{{$swap->itemB->name}}</p>
                                <img src="{{$imageB ? asset('storage/' . $imageB->image_path) : asset('images/no-image.png')}}" alt="" class="w-full h-auto rounded">
                            </div>
                        </div>
                    </a>
                    
                @endforeach               
            @else
                <p class="text-md mt-10">There are no offers</p>
            @endif
        </div>
    </div>
</div>
@endsection