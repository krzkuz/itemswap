<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{
    public function create(Request $request){
        $participant1_id = (int)session('recipientId') ?? (int)$request['recipientId'];
        $participant2_id = (int)auth()->id();
        $itemId = (int)session('itemId') ?? (int)$request['itemId'];
        //sorting participants ids
        $sortedParticipantIds = [$participant1_id, $participant2_id];
        sort($sortedParticipantIds);
        // dd($sortedParticipantIds);

        $conversation = Conversation::firstOrCreate([
            'item_id' => $itemId,
            'participant1_id' => $sortedParticipantIds[0],
            'participant2_id' => $sortedParticipantIds[1]
        ]);

        session()->forget('recipientId', 'itemId');

        return view('messages.messages', [
            'activeConversation' => $conversation
        ]);
    }
}
