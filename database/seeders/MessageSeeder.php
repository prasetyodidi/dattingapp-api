<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::query()->create([
            'chat_id' => 1,
            'sender_id' => 1,
            'message' => 'hello'
        ]);

        Message::query()->create([
            'chat_id' => 1,
            'sender_id' => 1,
            'message' => 'hai'
        ]);

        Message::query()->create([
            'chat_id' => 1,
            'sender_id' => 2,
            'message' => 'hai'
        ]);
    }
}
