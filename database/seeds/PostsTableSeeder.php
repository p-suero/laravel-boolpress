<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                "title" => "Come modificare lo sfondo del tuo smartphone",
                "content" => "Lorem ipsum",
                "slug" => "come-modificare-lo-sfondo-del-tuo-smartphone",
                "category_id" => 1
            ],
            [
                "title" => "Aumentare i follower nei social",
                "content" => "lorem ipsum",
                "slug" => "aumentare-i-follower-nei-social",
                "category_id" => 3
            ],
            [
                "title" => "Come disattivare gli aggiornamenti di windows",
                "content" => "lorem ipsum",
                "slug" => "come-disattivare-gli-aggiornamenti-di-windows",
                "category_id" => 4
            ]
        ];

        foreach ($posts as $post) {
            $new_post = new Post();
            $new_post->fill($post);
            $new_post->save();
        }
    }
}
