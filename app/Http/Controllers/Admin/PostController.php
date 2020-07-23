<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with("category","tags")->get();
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
        //valido i dati pervenuti dal form
        $request->validate([
            "title"=> "required|string|max:255|unique:posts,title",
            "content" => "required",
            "image" => "file|image"
        ]);
        //mappo i dati in un array dove la chiave è il name del form
        $data = $request->all();
        //genero uno slug
        $slug = Str::of($data['title'])->slug('-');
        $original_slug= $slug;
        $post = Post::where("slug", $slug)->first();
        $contatore = 0;
        while ($post) {
            $contatore++;
            $slug = $original_slug . '-' . $contatore;
            $post = Post::where('slug', $slug)->first();
        }
        //inserisco lo slag nell'array
        $data['slug'] = $slug;
        if (isset($data["image"])) {
            //aggiungo l'immagine in storage
            $img_path = Storage::put('uploads', $data['image']);
            //aggiungo l'immagine nell'array "data"
            $data["cover_image"] = $img_path;
        }
        //creo una nuova istanza del model post
        $new_post = new Post();
        //mappo i dati dell'array nell'istanza
        $new_post->fill($data);
        //inserisco i dati in database
        $new_post->save();
        //inserisco i tag nella tabella relazionale
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
        //genero uno slug
        $slug = Str::of($data['title'])->slug('-');
        //lo salvo in una variabile ad-hoc
        $original_slug= $slug;
        //richiamo i post con lo slug appena generagto
        $post_in_data = Post::where("slug", $slug)->first();
        //creo una variabile contatore
        $contatore = 0;
        //se la whete non mi restituisce un oggetto vuoto, modifico lo slug generato
        while ($post_in_data && $post->slug != $slug) {
            //incremento il contatore
            $contatore++;
            //concateno lo slug generato con il numero del contatore
            $slug = $original_slug . '-' . $contatore;
            //rieffettuo la verifica in database dello slug generato e concatenato
            $post_in_data = Post::where('slug', $slug)->first();
        }
        //inserisco lo slag nell'array
        $data['slug'] = $slug;
        if (isset($data["image"])) {
            //aggiungo l'immagine in storage
            $img_path = Storage::put('uploads', $data['image']);
            //aggiungo l'immagine nell'array "data"
            $data["cover_image"] = $img_path;
        }

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
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
