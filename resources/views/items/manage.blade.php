@extends('components.layout')
@section('content')
<div class="lg:grid gap-4 space-y-4 md:space-y-0 mx-4">

    @if(count($items) == 0)
    <p>No items found</p>
    @endif
    
    
    @foreach($items as $item)
        <x-item-manage-card :item="$item"/>
    @endforeach
</div>
@endsection