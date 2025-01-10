<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $friends = auth()->user()->friends;
        return view('messages.index', compact('friends'));
    }

    public function chat(User $friend)
    {
        $messages = Message::where(function ($query) use ($friend) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $friend->id);
        })->orWhere(function ($query) use ($friend) {
            $query->where('sender_id', $friend->id)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return view('messages.chat', compact('friend', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
