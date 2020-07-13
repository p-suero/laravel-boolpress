@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <h1 class="mb-4">Dettaglio post</h1>
            <div class="col-12">
                <p><strong>Id:</strong> {{$post->id}}</p>
                <p><strong>Title:</strong> {{$post->title}}</p>
                <p><strong>Content:</strong> {{$post->content}}</p>
                <p><strong>Slug:</strong> {{$post->slug}}</p>
                <p><strong>Creato il:</strong> {{$post->created_at}}</p>
                <p><strong>Aggiornato il:</strong> {{$post->updated_at}}</p>
            </div>
        </div>
    </div>
@endsection
