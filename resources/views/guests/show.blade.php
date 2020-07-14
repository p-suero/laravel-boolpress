@extends('layouts.app')
@section('page-title', "Dettaglio post")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Dettaglio post</h1>
                <p>Id: {{$post->id}}</p>
                <p>Title: {{$post->title}}</p>
                <p>Content: {{$post->content}}</p>
            </div>
        </div>
    </div>
@endsection
