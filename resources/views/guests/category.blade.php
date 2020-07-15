@extends('layouts.app')
@section('page-title', "Post per categorie")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Post categoria: "{{$category->name}}"</h1>
                @foreach ($category->posts as $post)
                    <p><strong>Titolo:</strong>
                        <a href="{{route("posts.show", ["slug" => $post->slug])}}">{{$post->title}}</a>
                    </p>
                @endforeach
            </div>
        </div>
    </div>

@endsection
