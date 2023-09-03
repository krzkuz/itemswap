@props(['item'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-100 mr-6 md:block"
            src="{{$item->image ? asset('storage/' . $item->image):
            asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl font-bold">
                <a href="/items/{{$item->id}}">{{$item->name}}</a>
            </h3>
            <div class="text-xl mb-4">{{$item->description}}</div>
            <x-item-tags :tags="$item->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$item->owner->address}}
            </div>
        </div>
    </div>
</x-card>