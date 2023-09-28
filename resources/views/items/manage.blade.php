@extends('components.layout')
@section('content')

<div class="flex justify-center mx-4 pb-5">
    @if(count($items) == 0)
    <p class="font-bold text-gray-400">No items found</p>
    @endif
</div>

@foreach($items as $item)    
    <x-item-card :currentUserId="$currentUserId" :item="$item" />
@endforeach

<div class="flex justify-evenly mt-6 mb-6">
    {{$items->links()}}
</div>
@endsection