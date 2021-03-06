@extends('layouts.dashboard')
@section('page-title',"Lista post")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Lista post</h1>
                    <a href="{{route("admin.posts.create")}}" class="btn btn-info">Aggiungi post</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titolo</th>
                            <th>Testo</th>
                            <th>Categoria</th>
                            <th>Tag</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>
                                    {{$post->id}}
                                </td>
                                <td>
                                    {{$post->title}}
                                </td>
                                <td>
                                    {{$post->content}}
                                </td>
                                <td>
                                    {{$post->category->name ?? "-"}}
                                </td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="{{route("admin.posts.show", ["post" => $post])}}" class="btn btn-primary btn-sm">Mostra dettagli</a>
                                    <a href="{{route("admin.posts.edit", ["post" => $post])}}" class="btn btn-warning btn-sm">Modifica post</a>
                                    <form class="d-inline" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                                       @csrf
                                       @method('DELETE')
                                       <input type="submit" class="btn btn-sm btn-danger" value="Elimina">
                                   </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">
                                    Nessun post
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
