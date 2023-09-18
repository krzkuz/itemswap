@extends('components.layout')
@section('content')
<div class="flex justify-center h-screen ">
    <div class="flex mt-10 w-5/6 h-4/6">
        <div class="w-7/12 bg-neutral-700 rounded px-2 py-4 overflow-y-auto">
            @if (isset($conversations))
                @foreach ($conversations as $conversation)
                    <div>
                        @php
                            $conversationImage = $conversation->item->images()->first();
                            $lastMessage = $conversation->messages()->latest()->first();
                        @endphp
                        <a href="{{route('messages', ['conversation'=>$conversation->id])}}" class="">
                            <div class="flex mx-4 border-b border-neutral-400 my-4">
                                <img src="{{$conversationImage ? asset('storage/' . $conversationImage->image_path):
                                asset('images/no-image.png')}}" alt="" class="h-16 w-2/12 rounded mb-5">
                                <div class="ml-5">
                                    <div class="flex">
                                        <h3 class="font-bold mr-5">{{$conversation->item->name}}</h3>
                                        <p class="text-xs">{{$lastMessage->created_at->format('m-d H:i')}}</p>
                                    </div>
                                    <p class="text-sm mb-5">{{ Str::limit($lastMessage->body, $limit = 60, $end = '...') }}</p>
                                </div>
                            </div>
                        </a>                
                    </div>
                @endforeach
            @endif
            
        </div>
        <div class="w-5"></div>
        <div class="flex flex-col w-full bg-neutral-700 rounded px-4 py-4">
            @if ($activeConversation)
                @php
                    $item = $activeConversation->item;
                @endphp
                <div class="flex mx-4 border-b border-neutral-400 my-4">
                    <img src="{{$item->images()->first() ? asset('storage/' . $item->images()->first()->image_path):
                    asset('images/no-image.png')}}" alt="" class="h-16 w-2/12 rounded mb-5">
                    <div class="ml-5 flex flex-col justify-center">
                        <h3 class="font-bold mr-5 mb-5">{{$activeConversation->item->name}}</h3>
                    </div>
                </div>
                <div class="overflow-y-auto mx-4">
                    @foreach ($activeConversation->messages as $message)
                        @if ($message->sender_id != auth()->id())
                            <div class="flex flex-col items-start">
                                <p class="text-xs">
                                    {{$message->created_at->format('m-d H:i')}}
                                </p>
                                <div class="flex max-w-[70%] text-sm bg-neutral-600 rounded px-2 py-2 mb-2">
                                    {{$message->body}}                        
                                </div>
                            </div>                        
                        @else
                            <div class="flex flex-col items-end mr-3">
                                <p class="text-xs">
                                    {{$message->created_at->format('m-d H:i')}}
                                </p>
                                <div class="flex max-w-[70%] text-sm bg-neutral-200 rounded px-2 py-2 mb-2">
                                    {{$message->body}} 
                                </div>                        
                            </div>                                            
                        @endif                   
                    @endforeach
                </div>
                
                <div class="flex bg-neutral-100 rounded-md mt-2 mx-4">
                    <form action="{{route('send-message', ['conversation' => $activeConversation->id])}}" method="POST">
                        @csrf
                        @php
                            if ($activeConversation->participant1->id == auth()->id()){
                                $recipientId = $activeConversation->participant2->id;
                            }
                            else {
                                $recipientId = $activeConversation->participant1->id;
                            }
                        @endphp
                        <input type="text" name="itemId" value="{{$activeConversation->item->id}}" hidden>
                        <input type="text" name="recipientId" value="{{$recipientId}}" hidden>

                        <div class="flex">
                            <textarea
                            class="text-sm bg-neutral-100 rounded w-full resize-none py-2 px-4"
                            name="body"
                            rows="2"
                            cols="200"

                            ></textarea>
                            <button class="mr-3">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        
                    </form>
                    

                </div>
            @else
                <p class="font-bold">Select a conversation to read it </p>
            @endif
            
        </div>
    
    </div>

</div>


@endsection