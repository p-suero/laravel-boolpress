@extends('layouts.dashboard')
@section('page-title', "Crea post")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-3 mb-3">Nuovo post</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" name="title" class="form-control" id="titolo" placeholder="Titolo post" value="{{ old('title') }}">
                        @error('title')
                            <small class='text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="testo">Testo articolo</label>
                        <textarea type="text" name="content" class="form-control" id="testo" placeholder="Inserisci il testo del post">{{ old('content') }}</textarea>
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
                                <option {{old("category_id") == $category->id ? "selected" : ""}} value="{{$category->id}}">{{$category->name}}</option>
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
                                    <input {{in_array($tag->id, old("tags", [])) ? "checked" : ""}} class="form-check-label" type="checkbox" name="tags[]" value="{{$tag->id}}">
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
