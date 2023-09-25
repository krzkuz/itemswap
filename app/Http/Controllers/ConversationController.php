<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{
    public function create(Request $request){
        $itemId = (int)session('itemId') ?? (int)$request['itemId'];
        dd($itemId);

        $ownerId = (int)Item::find($itemId)->owner->id;
        $participant1_id = $request['recipientId'] ?? $ownerId;
        // dd(session('recipientId'), $request['recipientId'], $ownerId);
        
        // dd($participant1_id);
        $participant2_id = auth()->id();
        //sorting participants ids
        $sortedParticipantIds = [$participant1_id, $participant2_id];
        sort($sortedParticipantIds);

        $conversation = Conversation::firstOrCreate([
            'item_id' => $itemId,
            'participant1_id' => $sortedParticipantIds[0],
            'participant2_id' => $sortedParticipantIds[1]
        ]);

        session()->forget('itemId');

        return view('messages.messages', [
            'activeConversation' => $conversation
        ]);
    }
}
