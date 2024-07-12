<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $chats = Chat::query()->where('user1_id', '=', $user->id)->with('user1')->get();

        // $chats1 = Chat::query()->where('user1_id', '=', 1)->with('user')->get();

        $userId = $request->user()->id;
        $result = $chats->map(function ($item) use ($userId) {
            return [
                'id' => $item->id,
                'user2_id' => $item->user2_id,
                'user1_id' => $item->user1_id,
                'user2_name' => $item->user2->name,
                'updated_at' => $item->updated_at->diffForHumans(),
                'last_message' => $item->last_message,
                "receiver_id" => $item->user1_id == $userId ? $item->user2_id : $item->user1_id,
            ];
        });

        return response()->json($result, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();
        $user1 = $user->id;

        $receiverId = $request->receiver_id;

        if ($user->id > $receiverId) {
            $user1 = $receiverId;
            $user2 = $user->id;
        } else {
            $user1 = $user->id;
            $user2 = $receiverId;
        }

        $chat = Chat::query()->create([
            'user1_id' => $user1,
            'user2_id' => $user2,
            'last_message' => ':*'
        ]);

        $message = Message::query()->create([
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => ':*'
        ]);

        $result = Chat::query()->first();
        $userId = $request->user()->id;
        $result = [
            'id' => $result->id,
            'user2_id' => $result->user2_id,
            'user1_id' => $result->user1_id,
            'user2_name' => $result->user2->name,
            'updated_at' => $result->updated_at->diffForHumans(),
            'last_message' => $result->last_message,
            "receiver_id" => $result->user1_id == $userId ? $result->user2_id : $result->user1_id,
        ];
        return response()->json($result, 201);
    }
}
