@extends('components.layout')
@section('content')
@include('partials._search')

@if(count($items) == 0)
    <div class="flex justify-center mx-4 pb-5">
        <p class="font-bold text-gray-400">No items found</p>
    </div>
@endif

<div class="flex justify-center">
    <div class="w-5/6">
        <div class="2xl:grid 2xl:grid-cols-2">
            @foreach($items as $item)    
                <x-item-small-card :currentUserId="$currentUserId" :item="$item" />
            @endforeach
        </div>
    </div>
</div>


<div class="flex justify-center">
    <div class="mt-6 mb-6 w-5/6 px-20">
        {{$items->links()}}
    </div>
</div>


@endsection

