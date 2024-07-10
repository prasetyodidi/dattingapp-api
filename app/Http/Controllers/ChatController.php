<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request) : JsonResponse {
        $user = $request->user();

        $chats = Chat::query()->where('sender_id', '=', $user->id)->with('receiver')->get();

        // $chats1 = Chat::query()->where('user1_id', '=', 1)->with('user')->get();

        $result = $chats->map(function ($item) {
            return [
                'id' => $item->id,
                'receiver_id' => $item->receiver_id,
                'sender_id' => $item->sender_id,
                'receiver_name' => $item->receiver->name,
                'updated_at' => $item->updated_at,
                'last_message' => $item->last_message,
            ];
        });

        return response()->json($result, 200);
    }
}
