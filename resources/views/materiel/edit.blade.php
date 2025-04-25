@extends('layouts.app')
@section('title')
    Modifier le matériel
@endsection
@section('content')
<div class="row layout-top-spacing">
<div class="col">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Modifier le matériel</h4>
                            <form method="POST" action="{{route('materiel.update', $materiel->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Nom</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nom du matériel">
                                        @error('nom')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                </div>
                                <div class="col-6">
                                        <label for="">Catégorie</label>
                                        <select class="form-control @error('categories_id') is-invalid @enderror" name="categories_id">
                                            <option value="">Choisir</option>
                                            @forelse (\App\Models\Categorie::all() as $ct)
                                                <option value="{{$ct->id}}">{{$ct->nom}}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                        @error('categories_id')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                </div>
                                <div class="col-12">
                                    <label for="">Détails</label>
                                    <textarea class="form-control @error('details') is-invalid @enderror" name="details" cols="15" rows="10" placeholder="Détails du matériel"></textarea>
                                    @error('details')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                </div>
                                
                                <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary" value="Sauvegarder">
                            </form>
                    </div>

                </div>
        </div>
        
    </div>
</div>
</div>
@endsection