<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                "name" => "Smartphone",
                "slug" => "smartphone"
            ],
            [
                "name" => "Siti e app",
                "slug" => "siti-e-app"
            ],
            [
                "name" => "Moda",
                "slug" => "moda"
            ],
            [
                "name" => "Desktop",
                "slug" => "desktop"
             ]
        ];

        foreach ($categories as $category) {
            $new_category = new Category();
            $new_category->fill($category);
            $new_category->save();
        }
    }
}
