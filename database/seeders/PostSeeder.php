<?php

namespace Database\Seeders;

use App\Models\Post;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert a single record
        Post::create([
            'title' => 'First Post',
            'content' => 'This is a demo post.',
            'user_id' => 1,
            'image' => 'https://via.placeholder.com/150'
        ]);

        Post::factory(20)->create();
    }
}
