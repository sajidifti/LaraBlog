<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Technology related posts.'],
            ['name' => 'Science', 'slug' => 'science', 'description' => 'Science related posts.'],
            ['name' => 'Entertainment', 'slug' => 'entertainment', 'description' => 'Entertainment related posts.'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business related posts.'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Lifestyle related posts.'],
            ['name' => 'Travel', 'slug' => 'travel', 'description' => 'Travel related posts.'],
            ['name' => 'Food', 'slug' => 'food', 'description' => 'Food related posts.'],
            ['name' => 'Music', 'slug' => 'music', 'description' => 'Music related posts.'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports related posts.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
