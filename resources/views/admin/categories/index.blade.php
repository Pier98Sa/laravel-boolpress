@extends('admin.layouts.base')

@section('pageTitle', 'BoolPress - Categorie')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{route('admin.categories.create')}}" class="btn btn-primary mb-2">Aggiungi una nuova categoria</a>


                
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td class="d-flex"> 
                                <!--buttoni delle azioni-->
                                <a href="{{route('admin.categories.show', $category->id)}}" class="btn btn-primary">Show</a>
                                <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-success mx-2">Edit</a>   

                                <!-- Button trigger modal -->
                                <!--nella onclick passare prima l'id e poi il nome della rotta-->
                                <button type="button" class="btn btn-danger" onclick="btnDelete('{{$category->id}}', 'categories');" data-toggle="modal" data-target="#cancel" >
                                    Remove
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="cancel" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminazione</h5>
                                                <button type="button" class="close" data-dismiss="modal" >
                                                    <span >&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Sei sicuro di voler cancellare la categoria ?</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="" method="POST" name="myForm" id='myForm'>
                                                    @csrf
                                                    @method('DELETE') 
                                                    
                                                    <button type="submit"  class="btn btn-danger">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection