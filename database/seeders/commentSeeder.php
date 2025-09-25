<?php

namespace Database\Seeders;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample comments
        Comment::create([
            'post_id' => 1,
            'user_id' => 1,
            'content' => 'Great article! Very informative.',

        ]);
    }
}
