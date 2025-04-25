@extends('layouts.app')
@section('title')
    Catégories
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col-5 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Ajouter une catégorie</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{route('categorie.store')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="">Nom de la catégorie</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nom de la catégorie">
                        @error('nom')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>                   
                    
                    <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary" value="Sauvegarder">
                </form>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Les catégories</h4>
                        <div class="table-responsive">
                            <table class="table table-stripped table-hovered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Catégorie</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $categorie)
                                        <tr>
                                            <td>{{$categorie->id}}</td>
                                            <td>{{$categorie->nom}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            {{-- <a href="{{route('categorie.edit', $categorie->id)}}">Modifier</a><br> --}}
                                                            <form class="f-del" action="{{route('categorie.edit', $categorie->id)}}" method="GET">
                                                                <input type="submit" class="dropdown-item" value="Modifier">
                                                            </form>
                                                            <form class="f-del" action="{{route('categorie.destroy',$categorie->id)}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="submit" class="dropdown-item" value="Supprimer">
                                                            </form>
                                                    </div>
                                                  </div>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection