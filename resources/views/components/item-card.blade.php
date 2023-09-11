@props(['item'])
@props(['currentUserId'])

<div class="flex justify-center mx-4 pb-5">
    <x-card>
        <div class="flex">
                @php
                    $firstIteration = true;  
                    $mainPicture = $item->images->first();          
                @endphp
                <div class="flex flex-col">
                    @if($mainPicture)
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
                    <div class="text-lg mt-4 mb-4">
                        <i class="fa-solid fa-location-dot"></i> {{$item->owner->country}} <a href="">{{$item->owner->city}}</a> {{$item->owner->address}}
                    </div>
                    @if ($currentUserId != $item->user_id)
                    <div class="flex flex-wrap">

                        <form action="" method="POST">
                            @csrf
                            <button class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">
                                <i class="fa-solid fa-right-left"></i> Swap
                            </button>
                        </form>

                        <form action="{{route('create-message')}}" method="POST">
                            @csrf
                            <input type="text" name="itemId" value="{{$item->id}}" hidden>
                            <input type="text" name="recipientId" value="{{$item->user_id}}" hidden>
                            <button class="bg-zinc-800 text-white rounded py-2 px-4 hover:bg-black mr-2 mb-2">
                                <i class="fa-solid fa-message"></i> Message
                            </button>
                        </form>
                    </div>
                        
                    @endif
                </div>

            </div>
                
            
            
    </x-card>
</div>
