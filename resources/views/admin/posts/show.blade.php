@extends('admin.layouts.base')
@section('pageTitle') 
    BoolPress - {{$post->title}}
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
                <h1 class="text-center">Visualizza Post</h1>
                @if ($post->cover)
                    <img class="img-fluid h-25 " src="{{asset('storage/'. $post->cover )}}" alt="{{$post->title}}">
                @else
                    <img class="img-fluid h-25" src="{{asset('img/fallback_img.jpg' )}}" alt="{{$post->title}}">
                @endif
                <div><strong>Titolo: </strong>{{$post->title}}</div>
                <div><strong>Autore: </strong>{{$post->author}}</div>
                <div><strong>Categoria: </strong>{{isset($post->category)? $post->category->name : '-'}}</div>
                <div><strong>Contenuto: </strong>{{$post->content}}</div>
                <div><strong>Slug: </strong>{{$post->slug}}</div>
                <div>
                    <strong>Tags: </strong>
                    @foreach ($post->tags as $tag)
                        <a href="{{route('admin.tags.show', $tag->id)}}" class="badge badge-primary p-2">{{$tag->name}}</a>
                    @endforeach
                </div>

                <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-2">Ritorna alla lista</a>
          </div>
      </div>
  </div>
@endsection