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
            <div class="mt-10 flex">
                <a href="/items/{{$item->id}}/edit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium 
                    rounded-lg text-sm px-5 py-2.5 mr-5">Edit</a>
                <form action="/items/{{$item->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium 
                        rounded-lg text-sm px-5 py-2.5 ">Delete</button>
                </form>
                    
            </div>
        </div>
    </div>
</x-card>