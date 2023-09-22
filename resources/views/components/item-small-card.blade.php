@props(['item'])
@props(['currentUserId'])

<div class="w-full h-auto">
    <a href="{{route('show-listing', ['item' => $item->id])}}">

    <div class='bg-neutral-700 rounded p-6 m-5'>

        <div class="flex">
            @php
                $mainPicture = $item->images->first();          
            @endphp
            <div class="flex">
                @if($mainPicture)
                    <img
                    class="rounded h-80"
                    src="{{asset($mainPicture->cropped_image_path)}}"
                    alt=""
                    />
                @else
                    <img
                    class="rounded h-80"
                    src="{{asset('images/no-image.png')}}"
                    alt=""
                    />
                @endif                 
            </div>

            <div class="flex flex-col pl-10 w-1/2">
                <h3 class="text-2xl">
                    {{$item->name}}
                </h3>
                <div class="flex justify-between mt-auto text-sm font-medium">
                    <form action="/">
                        <i class="fa-solid fa-location-dot"></i> 
                        <input type="text" name="location" value="{{$item->owner->city}}" hidden>
                        <button>{{$item->owner->city}}</button> 
                        {{$item->owner->country}}
                    </form>
                        

                     
                    <span class="font-thin">Posted {{$item->updated_at->format('d-m H:i')}}</span>
                </div>
            </div>

        </div>

    </div>    
</a>

</div>