@extends('admin.layouts.base')
@section('pageTitle') 
  BoolPress - Modifica {{$tag->name}}
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <h1 class="text-center">Modifica il tag "{{$tag->name}}" </h1>

              <form method="POST" action="{{ route('admin.tags.update', $tag->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="name">Nome del Tag</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{old('name', $tag->name)}}">
                </div>

                <button type="submit" class="btn btn-primary">Salva</button>
              </form>

          </div>
      </div>
  </div>
@endsection