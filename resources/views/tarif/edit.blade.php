@extends('layouts.app')
@section('title')
    Modifier tarif
@endsection
@section('content')
<div class="row layout-top-spacing">
<div class="col">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                    <h4>Modifier le tarif</h4>
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{route('tarif.update', $tarif->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-4">
                                    <label for="">Matériel</label>
                                    <select class="form-control @error('materiels_id') is-invalid @enderror" name="materiels_id">
                                        <option value="{{$tarif->materiels_id}}">{{\App\Models\Materiel::find($tarif->materiels_id)->nom}}</option>
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
                                        <option value="{{$tarif->typelocations_id}}">{{\App\Models\Typelocation::find($tarif->typelocations_id)->type}}</option>
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
                                    <input type="number" min="0" class="form-control @error('montant') is-invalid @enderror" name="montant" placeholder="Montant" value="{{$tarif->montant}}">
                                    @error('montant')
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