@extends('layouts.app')
@section('page-title', "Dettaglio post")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-3">{{$post->title}}</h1>
                <p><strong>Testo: </strong>{{$post->content}}</p>
                <p><strong>Categoria: </strong>
                    @if ($post->category)
                        <a href="{{route("category.show", ["slug"=> $post->category->slug])}}">
                            {{$post->category->name}}
                        </a>
                    @else
                        {{"-"}}
                    @endif
                </p>
                <p>
                    <strong>
                        Tags:
                    </strong>
                    @forelse ($post->tags as $tag)
                        <a href="{{route("tag.show", ["slug"=> $tag->slug])}}">{{$tag->name}}</a>
                        @if ($loop->last)
                            {{""}}
                        @else
                            {{","}}
                        @endif
                    @empty
                        {{"-"}}
                    @endforelse
                </p>
            </div>
        </div>
    </div>
@endsection
