<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function send(Request $request, $conversationId){
        $formFields = $request->validate([
            'body' => 'required',
        ]);

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
            'activeUserId' => $userId
        ]);
    }
}
