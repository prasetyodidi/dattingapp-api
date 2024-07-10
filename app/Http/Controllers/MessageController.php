<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request, $chatId) : JsonResponse {
        $messages = Message::query()->where('chat_id', '=', $chatId)->get();

        $data = $messages->map(function ($item) {
            return [
                ''
            ];
        });

        return response()->json($messages);
    }


    public function store(Request $request) : JsonResponse {
        $request->validate([
            'chat_id' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'sender_id' => $request->user()->id,
            'chat_id' => $request->chat_id,
            'message' => $request->message,
        ];

        $message = Message::query()->create($data);

        return response()->json($message);
    }
}
