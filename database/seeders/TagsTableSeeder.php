<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    public function run(): void
    {
        $hashtags = [
            '#Technology',
            '#AI',
            '#Health',
            '#Business',
            '#Sports',
            '#Travel',
            '#Design',
        ];

        foreach ($hashtags as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }
    }
}
