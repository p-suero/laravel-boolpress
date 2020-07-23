<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                "name" => "Windows",
                "slug" => "windows"
            ],
            [
                "name" => "Ios",
                "slug" => "ios"
            ],
            [
                "name" => "Android",
                "slug" => "Android"
            ],

        ];

        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->fill($tag);
            $new_tag->save();
        }
    }
}
