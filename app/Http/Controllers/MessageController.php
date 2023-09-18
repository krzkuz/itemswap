<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    // public function create(){
    //     $recipientId = session('recipientId');
    //     $itemId = session('itemId');
    //     session()->forget('recipientId', 'itemId');
    //     return view('messages.create', [
    //         'recipientId' => $recipientId,
    //         'itemId' => $itemId,
    //     ]);
    // }

    public function send(Request $request, $conversationId){
        // dd($request['itemId'], $request['recipientId']);
        // dd($conversationId);
        $formFields = $request->validate([
            'body' => 'required',
        ]);

        // $participant1_id = (int)$request['recipientId'];
        // $participant2_id = auth()->id();

        // //sorting participants ids
        // $sortedParticipantIds = [$participant1_id, $participant2_id];
        // sort($sortedParticipantIds);

        // $conversation = Conversation::firstOrCreate([
        //     'item_id' => $request['itemId'],
        //     'participant1_id' => $sortedParticipantIds[0],
        //     'participant2_id' => $sortedParticipantIds[1]
        // ]);
        $conversation = Conversation::find($conversationId);
        $conversation->messages()->create([
            'body' => $formFields['body'],
            'sender_id' => auth()->id()
        ]);

        return redirect()->route('messages', ['conversation' => (int)$conversationId]);
    }

    public function messages($id = null){
        $userId = auth()->id();
        $conversations = Conversation::where('participant1_id', $userId)
            ->orWhere('participant2_id', $userId)
            ->with('messages', 'item')
            ->get();
        if($id===null){
            $activeConversation = null;
        }
        else{
            $activeConversation = Conversation::find($id);
        }
        return view('messages.messages', [
            'conversations' => $conversations,
            'activeConversation' => $activeConversation,
            'activeUserId' => auth()->id()
        ]);
    }
}
