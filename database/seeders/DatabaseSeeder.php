<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User satu',
            'email' => 'satu@gmail.com',
            'profile_url' => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=User+satu'
        ]);

        User::factory()->create([
            'name' => 'User dua',
            'email' => 'dua@gmail.com',
            'profile_url' => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=User+dua'
        ]);

        User::factory()->create([
            'name' => 'User tiga',
            'email' => 'tiga@gmail.com',
            'profile_url' => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=User+tiga'
        ]);

        User::factory()->create([
            'name' => 'User empat',
            'email' => 'empat@gmail.com',
            'profile_url' => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=User+tiga'
        ]);

        $this->call([
            ChatSeeder::class,
            MessageSeeder::class
        ]);
    }
}
