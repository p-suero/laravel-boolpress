<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with("category")->get();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            "categories" => $categories,
            "tags" => $tags
        ];
        return view("admin.posts.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=> "required|string|max:255|unique:posts,title",
            "content" => "required"
        ]);
        $data = $request->all();
        $slug = Str::of($data['title'])->slug('-');
        $original_slug= $slug;
        $post = Post::where("slug", $slug)->first();
        $contatore = 0;
        while ($post) {
            $contatore++;
            $slug = $original_slug . '-' . $contatore;
            $post = Post::where('slug', $slug)->first();
        }
        $data['slug'] = $slug;
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
        if (!empty($data["tags"])) {
            $new_post->tags()->sync($data["tags"]);
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            "categories" => $categories,
            "post" => $post,
            "tags" => $tags
        ];
        return view("admin.posts.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title"=> "required|string|max:255|unique:posts,title," .$post->id,
            "content" => "required"
        ]);
        $data = $request->all();
        $slug = Str::of($data['title'])->slug('-');
        $data['slug'] = $slug;
        $post->update($data);
        if (!empty($data["tags"])) {
            $post->tags()->sync($data["tags"]);
        } else {
            $post->tags()->detach();
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
