@extends('layouts.app')
@section('page-title', "Lista post")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1 class="mb-5">Lista post</h1>
                        @foreach ($posts as $post)
                            <ul>
                                <li>
                                    <a href="{{route("posts.show", ["slug" => $post->slug])}}">{{$post->title}}</a>
                                </li>
                            </ul>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
