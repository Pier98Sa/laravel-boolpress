@extends('admin.layouts.base')
@section('pageTitle', 'BoolPress - Nuovo Tag')
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <h1 class="text-center">Crea un nuovo post </h1>

              <form method="POST" action="{{ route('admin.tags.store') }}">
                @csrf
                <div class="form-group">
                  <label for="name">Nome del Tag</label>
                  <input type="text" class="form-control" id="name" name="name" >
                </div>

                <button type="submit" class="btn btn-primary">Salva</button>
              </form>

          </div>
      </div>
  </div>
@endsection