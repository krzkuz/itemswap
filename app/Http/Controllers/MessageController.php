<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create(Request $request){
        $recipientId = $request['recipientId'];
        $itemId = $request['itemId'];
        return view('messages.create', [
            'recipientId' => $recipientId,
            'itemId' => $itemId,
        ]);
    }

    public function send(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Message::create([
            'title' => $formFields['title'],
            'body' => $formFields['body'],
            'item_id' => $request['itemId'],
            'recipient_id' => $request['recipientId'],
            'sender_id' => auth()->id()
        ]);
        // $message->save();

        return redirect('/')->with('message', 'Message sent');
    }
}
