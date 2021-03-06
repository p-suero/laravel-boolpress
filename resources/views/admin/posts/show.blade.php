@extends('layouts.dashboard')
@section('page-title',"Dettaglio post")

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="mb-4">Dettaglio post</h1>
            <div class="col-12">
                @if ($post->cover_image)
                    <img src="{{asset("storage/". $post->cover_image)}}" alt="">
                @endif
                <p><strong>Id:</strong> {{$post->id}}</p>
                <p><strong>Title:</strong> {{$post->title}}</p>
                <p><strong>Content:</strong> {{$post->content}}</p>
                <p><strong>Slug:</strong> {{$post->slug}}</p>
                <p><strong>Categoria:</strong> {{$post->category->name ?? "-"}}</p>
                <p>
                    <strong>
                        Tags:
                    </strong>
                    @forelse ($post->tags as $tag)
                        {{$tag->name}}
                        @if ($loop->last)
                            {{""}}
                        @else
                            {{","}}
                        @endif
                    @empty
                        {{"-"}}
                    @endforelse
                </p>
                <p><strong>Creato il:</strong> {{$post->created_at}}</p>
                <p><strong>Aggiornato il:</strong> {{$post->updated_at}}</p>
            </div>
        </div>
    </div>
@endsection
