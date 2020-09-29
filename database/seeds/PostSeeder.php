<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => "Post 1 from Seeder",
            'abstract' => 'Post 1 from Seeder Abstract',
            'text' => "Post 1 from Seeder Text",
        ]);
        Post::create([
            'title' => "Post 2 from Seeder",
            'abstract' => 'Post 2 from Seeder Abstract',
            'text' => "Post 2 from Seeder Text",
        ]);
        Post::create([
            'title' => "Post 3 from Seeder",
            'abstract' => 'Post 3 from Seeder Abstract',
            'text' => "Post 3 from Seeder Text",
        ]);
    }
}
