<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts_number = Post::all()->count();
        for ($i = 1; $i <= $posts_number ; $i++) {
            $post = Post::find($i);
            $post->tags()->attach(rand(1,3));
        }
    }
}
