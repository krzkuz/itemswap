@props(['item'])
@props(['currentUserId'])


<div class="flex justify-center mx-4 pb-5">
    <div class='bg-neutral-700 rounded p-6 m-25 w-5/6  h-4/6'>
        <div class="flex">
            @php
                $firstIteration = true;  
                $mainPicture = $item->images->first();          
            @endphp
            <div class="flex flex-col">
                <img
                class="rounded mb-1"
                src="{{$mainPicture ? asset('storage/' . $mainPicture->image_path):
                asset('images/no-image.png')}}"
                alt=""
                />
                
                <div class="flex flex-wrap">
                    @foreach ($item->images as $image)
                        <a href="{{asset('storage/' . $image->image_path)}}" data-lightbox="mygallery">
                            <img
                            class="w-20 h-20 m-1 rounded-md hover:grayscale 
                            transform scale-100 hover:scale-110 transition-transform"
                            src="{{asset($image->cropped_image_path)}}"
                            alt=""
                            />
                        </a>                            

                        @php
                            $firstIteration = false;
                        @endphp
                    @endforeach  
                </div>
                 
            </div>

            <div class="flex-none w-1/2 p-5">
                <h3 class="text-2xl font-bold">
                    <a href="{{route('show-listing', ['item' => $item->id])}}">{{$item->name}}</a>
                </h3>
                <div class="text-xl mb-4">{{$item->description}}</div>
                <x-item-tags :tags="$item->tags"/>
                <div class="text-lg mt-4 mb-4">
                    <i class="fa-solid fa-location-dot"></i> {{$item->owner->country}} <a href="">{{$item->owner->city}}</a> {{$item->owner->address}}
                </div>
                @if (auth()->id() != $item->user_id)
                <div class="flex flex-wrap">
                    <a href="{{route('swap-request', ['item' => $item->id])}}" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">
                        <i class="fa-solid fa-right-left"></i> Swap
                    </a>

                    <a href="{{route('create-conversation', ['item' => $item->id])}}" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">
                        <i class="fa-solid fa-message"></i> Message
                    </a>
                </div>
                @else
                    <div class="flex mt-10">
                        <a href="{{route('edit-listing-form', ['item' => $item->id])}}" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">Edit</a>
                        <form action="{{route('delete-listing', ['item' => $item->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">Delete</button>
                        </form>
                            
                    </div>
                @endif
            </div>

        </div>
    </div>    
</div>
