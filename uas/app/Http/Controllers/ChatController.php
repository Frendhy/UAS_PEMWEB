<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Fetch messages (latest 100).
     */
    public function index()
    {
        try {
            $messages = Message::with('user:id,name') // Lazy load untuk mengambil nama pengirim
                ->orderBy('created_at', 'asc')
                ->take(100)
                ->get()
                ->map(function ($message) {
                    return [
                        'message_text' => $message->message_text,
                        'sender_id' => $message->sender_id,
                        'sender_name' => $message->user->name ?? 'Unknown',
                        'sent_at' => $message->created_at->format('H:i:s d/m/Y'),
                    ];
                });

            Log::info('Fetched messages successfully.');
            return response()->json($messages);
        } catch (\Exception $e) {
            Log::error('Error fetching messages: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Store a new message.
     */
    public function store(Request $request)
    {
        // Pastikan pengguna telah login
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validasi input
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        try {
            $message = Message::create([
                'message_text' => $request->input('message'),
                'sender_id' => auth()->id(),
            ]);

            Log::info('Message stored successfully.', ['message_id' => $message->id]);

            // Hapus pesan terlama jika jumlah lebih dari 100
            if (Message::count() > 100) {
                Message::oldest()->first()->delete();
                Log::info('Oldest message deleted to maintain limit of 100 messages.');
            }

            return response()->json([
                'message_text' => $message->message_text,
                'sender_id' => $message->sender_id,
                'sender_name' => auth()->user()->name,
                'sent_at' => $message->created_at->timezone('Asia/Jakarta')->format('H:i:s d/m/Y'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing message: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}