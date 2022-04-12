@extends('admin.layouts.base')
@section('pageTitle') 
    BoolPress - {{$tag->title}}
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <h1 class="text-center">Visualizza Tag</h1>

              <div><strong>Tag: </strong>{{$tag->name}}</div>
              <div><strong>Slug: </strong>{{$tag->slug}}</div>
              <div>
                <strong>Post: </strong>
                <ul>
                   @foreach ($tag->posts as $post)
                        <li >
                            <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
                        </li>
                    @endforeach 
                </ul>
                
            </div>
              <a href="{{route('admin.tags.index')}}" class="btn btn-primary">Ritorna alla lista</a>

          </div>
      </div>
  </div>
@endsection