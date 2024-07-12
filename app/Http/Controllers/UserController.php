<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->profile_url = $request->file_url;
        $user->save();

        return response()->json($user);
    }

    public function getRandomUser(Request $request) : JsonResponse {
        $randomUser = User::inRandomOrder()->first();

        return response()->json($randomUser);
    }
}
