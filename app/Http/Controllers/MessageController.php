<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index(Request $request, $chatId): JsonResponse
    {
        $messages = Message::query()->where('chat_id', '=', $chatId)->get();

        $userId = $request->user()->id;
        $result = $messages->map(function ($item) use ($userId) {
            $isSender = $userId == $item->sender_id ? true : false;
            return [
                "id" => $item->id,
                "is_sender" => $isSender,
                "created_at" => $item->created_at->diffForHumans(),
                "message" => $item->message,
                "profile_url" => $item->receiver->profile_url
            ];
        });

        return response()->json($result);
    }

    public function store(Request $request): JsonResponse
    {
        Log::debug($request);
        $request->validate([
            'chat_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'chat_id' => $request->chat_id,
            'message' => $request->message,
        ];

        $message = Message::query()->create($data);
        $message = Message::query()->with('receiver')->find($message->id);
        $userId = $request->user()->id;
        $isSender = $userId == $message->sender_id ? true : false;

        $result = [
            "id" => $message->id,
            "is_sender" => $isSender,
            "created_at" => $message->created_at->diffForHumans(),
            "message" => $message->message,
            "profile_url" => $message->receiver->profile_url
        ];

        return response()->json($result, 201);
    }
}
