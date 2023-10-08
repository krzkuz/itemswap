<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;



class MessageController extends Controller
{
    public function send(Request $request, int $conversationId) : RedirectResponse {
        $formFields = $request->validate([
            'body' => 'required',
        ]);

        $conversation = Conversation::find($conversationId);
        $conversation->messages()->create([
            'body' => $formFields['body'],
            'sender_id' => auth()->id()
        ]);

        return redirect()
            ->route('messages', ['conversation' => (int)$conversationId]);
    }

    public function messages(int $id = null) : View {
        $activeUserId = auth()->id();
        $conversations = Conversation::where('participant1_id', $activeUserId)
            ->orWhere('participant2_id', $activeUserId)
            ->with('messages', 'item')
            ->get();
        if($id===null){
            $activeConversation = null;
        }
        else{
            $activeConversation = Conversation::find($id);
        }
        return view('messages.messages', compact('conversations', 'activeConversation', 'activeUserId'));
    }
}
