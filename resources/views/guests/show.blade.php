@extends('layouts.app')
@section('page-title', "Dettaglio post")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-3">{{$post->title}}</h1>
                <p><strong>Testo: </strong>{{$post->content}}</p>
                <p><strong>Categoria: </strong>{{$post->category->name ?? "-"}}</p>
            </div>
        </div>
    </div>
@endsection
