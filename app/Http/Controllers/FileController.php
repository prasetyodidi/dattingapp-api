<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('uploads', 'directly_to_public');
                Log::debug("path", ['data' => $path]);

                $url = Storage::disk('directly_to_public')->url($path);
                return response()->json(['url' => $url], 200);
            }

            Log::debug("file not found");
            return response()->json(['error' => 'No file uploaded'], 400);
        } catch (\Throwable $th) {
            Log::debug("error: ", ['data' => $th]);
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }
}
