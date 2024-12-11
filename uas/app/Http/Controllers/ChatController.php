<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        try {
            $messages = Message::latest()->take(100)->get();
            Log::info('Fetched messages:', $messages->toArray());
            return response()->json($messages);
        } catch (\Exception $e) {
            Log::error('Error fetching messages:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Log::info('Authenticated User:', [auth()->user()]);

        $request->validate([
            'message' => 'required|string'
        ]);

        $message = new Message();
        $message->message_text = $request->input('message');
        $message->sender_id = auth()->id();
        $message->save();

        Log::info('Saved message:', $message->toArray());

        if (Message::count() > 100) {
            Message::oldest()->first()->delete();
        }

        return response()->json($message);
    }
}
