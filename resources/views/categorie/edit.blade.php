@extends('layouts.app')
@section('title')
    Modifier un catégorie
@endsection
@section('content')
<div class="row layout-top-spacing">
<div class="col">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                    <h4>Modifier le catégorie</h4>
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{route('categorie.update', $categorie->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-4">
                                    <label for="">Nom du catégorie</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nom du catégorie" value="{{$categorie->nom}}">
                                    @error('nom')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                
                                <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary" value="Sauvegarder">
                            </form>
                        </div>
                        <div class="col"></div>
                    </div>

                </div>
        </div>
        
    </div>
</div>
</div>
@endsection