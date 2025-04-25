@extends('layouts.app')
@section('title')
    Tarifs
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col-5 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Ajouter une tarification</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{route('tarif.store')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="">Matériel</label>
                        <select class="form-control @error('materiels_id') is-invalid @enderror" name="materiels_id">
                            <option value="">Choisir</option>
                            @forelse (\App\Models\Materiel::all() as $mt)
                                <option value="{{$mt->id}}">{{$mt->nom}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                        @error('materiels_id')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Type tarification</label>
                        <select class="form-control @error('typelocations_id') is-invalid @enderror" name="typelocations_id">
                            <option value="">Choisir</option>
                            @forelse (\App\Models\Typelocation::all() as $tl)
                                <option value="{{$tl->id}}">par {{$tl->type}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                        @error('typelocations_id')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Montant</label>
                        <input type="number" min="0" class="form-control @error('montant') is-invalid @enderror" name="montant" placeholder="Montant">
                        @error('montant')
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
                        <h4>Les tarifications</h4>
                        <div class="table-responsive">
                            <table class="table table-stripped table-hovered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Materiel</th>
                                        <th>Montant</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tarifs as $tarif)
                                        <tr>
                                            <td>{{$tarif->id}}</td>
                                            <td>{{$tarif->materiels->nom}}</td>
                                            <td>{{$tarif->montant}}FCFA / {{\App\Models\Typelocation::find($tarif->typelocations_id)->type}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            {{-- <a href="{{route('tarif.edit', $tarif->id)}}">Modifier</a><br> --}}
                                                            <form class="f-del" action="{{route('tarif.edit', $tarif->id)}}" method="GET">
                                                                <input type="submit" class="dropdown-item" value="Modifier">
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