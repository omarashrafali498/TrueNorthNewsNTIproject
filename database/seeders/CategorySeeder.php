<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'description' => 'All about tech and programming'],
            ['name' => 'Politics', 'description' => 'Government, policies, and debates'],
            ['name' => 'Health & Wellness', 'description' => 'Tips for better living'],
            ['name' => 'Business', 'description' => 'Entrepreneurship and markets'],
            ['name' => 'Entertainment', 'description' => 'Movies, music, and culture'],
            ['name' => 'Sports', 'description' => 'Football, basketball, and more'],
            ['name' => 'Science', 'description' => 'Discoveries and research'],
            ['name' => 'Travel', 'description' => 'Places and experiences around the world'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
