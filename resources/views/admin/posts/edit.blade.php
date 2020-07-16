@extends('layouts.dashboard')
@section('page-title',"Modifica post")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 mb-3">Modifica post</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.posts.update', ["post"=>$post->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" name="title" class="form-control" id="titolo" placeholder="Titolo post" value="{{ old('title', $post->title) }}">
                        @error('title')
                            <small class='text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="testo">Testo articolo</label>
                        <textarea type="text" name="content" class="form-control" id="testo" placeholder="Inserisci il testo del post">{{ old('content',$post->content) }}</textarea>
                        @error('content')
                            <small class='text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="immagine">Immagine di copertina</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria: </label>
                        <select id="categoria" class="form-control" name="category_id">
                            <option value="">Scegli una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{old("category_id", ($post->category_id)) == $category->id ? "selected" : ""}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('content')
                            <small class='text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        Tag:
                        @foreach ($tags as $tag)
                            <div class="checkbox-item">
                                <label class="form-check-label">
                                    <input
                                        @if ($errors->any())
                                            {{in_array($tag->id, old("tags", [])) ? "checked" : ""}}
                                        @else
                                            {{ $post->tags->contains($tag) ? 'checked' : '' }}
                                        @endif class="form-check-label" type="checkbox" name="tags[]" value="{{$tag->id}}">
                                    {{$tag->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
