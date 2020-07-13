@extends('layouts.dashboard')
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
                            <th>Title</th>
                            <th>Content</th>
                            <th>Slug</th>
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
                                    {{$post->slug}}
                                </td>
                                <td>
                                    <a href="{{route("admin.posts.show", ["post" => $post])}}" class="btn btn-primary btn-sm">Mostra dettagli</a>
                                    <a href="#" class="btn btn-warning btn-sm">Modifica post</a>
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
