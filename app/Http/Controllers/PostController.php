<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return view("guests.index", compact("posts"));
    }

    public function show($slug) {
        $post = Post::where("slug", $slug)->first();
        if ($post) {
            return view("guests.show", compact("post"));
        } else {
            return abort("404");
        }
    }

    public function category($slug) {
        $category = Category::where("slug",$slug)->first();
        if ($category) {
            return view("guests.category", compact("category"));
        } else {
            return abort("404");
        }
    }
}
