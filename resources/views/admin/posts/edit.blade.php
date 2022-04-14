@extends('admin.layouts.base')
@section('pageTitle') 
  BoolPress - Modifica {{$post->title}}
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <h1 class="text-center">Modifica "{{$post->title}}"</h1>
              <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($post->cover)
                  <h3>Immagine attuale</h3>
                  <img class=" w-25" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
                @endif

                <div class="form-group">
                  <label for="image">Carica nuova immagine di copertina</label>
                  <input class="form-control" type="file" name="image" id="image">
                </div>

                <div class="form-group">
                  <label for="title">Titolo</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
                </div>

                <div class="form-group">
                  <label for="author">Autore</label>
                  <input type="text" class="form-control" id="author" name="author" value="{{old('author', $post->author)}}">
                </div>

                <div class="form-group">
                  <label for="category_id">Categoria</label>
                  <select id="category_id" name="category_id" class="form-control">
                   
                    <option {{('category_id' == '')? 'selected' : ''}} value="">Nessuna categoria selezionata</option>
                    @foreach ($categories as $category)
                      <option {{(old('category_id', ) == $category->id) ? 'selected': '' }} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="content">Contenuto del post</label>
                  <textarea class='form-control' name="content" id="content" cols="30" rows="10"> {{old('content', $post->content)}}</textarea>
                </div>

                @foreach ($tags as $tag)

                  @if ($errors->any())
                    <div class="custom-control custom-checkbox">
                      <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value={{$tag->id}} {{in_array($tag->id, old('tags'))? 'checked': ''}}       >
                      <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                    </div>
                  
                  @else
                    <div class="custom-control custom-checkbox">
                      <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value={{$tag->id}} {{( $post->tags->contains($tag) )? 'checked':''}}       >
                      <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                    </div>
                  @endif
                

                @endforeach

                <button type="submit" class="btn btn-primary">Salva</button>
              </form>

          </div>
      </div>
  </div>
@endsection