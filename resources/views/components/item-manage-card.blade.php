@props(['item'])
<div class="flex justify-center mx-4 pb-5">
    <x-card>
        <div class="flex">
            @php
                $firstIteration = true;  
                $mainPicture = $item->images->first();          
            @endphp
            <div class="flex flex-col">
                @if($firstIteration)
                    <img
                    class="w-full p-5"
                    src="{{$mainPicture ? asset('storage/' . $mainPicture->image_path):
                    asset('images/no-image.png')}}"
                    alt=""
                    />
                @endif
                
                <div class="flex">
                    @foreach ($item->images as $image)
                        @if (!$firstIteration)
                                <img
                                class="w-28 h-28 p-5"
                                src="{{$image ? asset('storage/' . $image->image_path):
                                asset('images/no-image.png')}}"
                                alt=""
                                />
                        @endif
                        @php
                            $firstIteration = false;
                        @endphp
                    @endforeach  
                </div>
                
            </div>
            <div class="flex-none w-1/2 p-10 pt-5">
                <h3 class="text-2xl font-bold">
                    <a href="/items/{{$item->id}}">{{$item->name}}</a>
                </h3>
                <div class="text-xl mb-4">{{$item->description}}</div>
                <x-item-tags :tags="$item->tags"/>
                <div class="text-lg mt-4">
                    <i class="fa-solid fa-location-dot"></i> {{$item->owner->country}} {{$item->owner->city}} {{$item->owner->address}}
                </div>
                <div class="mt-10 flex">
                    <a href="/items/{{$item->id}}/edit" class="text-white bg-black hover:bg-gray-900 hover:text-gray-400 font-medium 
                        rounded-lg text-sm px-4 py-2.5 mr-4">Edit</a>
                    <form action="/items/{{$item->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-black hover:bg-gray-900 hover:text-gray-400 font-medium 
                        rounded-lg text-sm px-4 py-2.5 mr-4">Delete</button>
                    </form>
                        
                </div>
            </div>
        </div>
    </x-card>
</div>