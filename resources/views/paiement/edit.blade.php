@extends('layouts.app')
@section('title')
    Modifier le client
@endsection
@section('content')
<div class="row layout-top-spacing">
<div class="col">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Modifier le client</h4>
                            <form method="POST" action="{{route('client.update', $client->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Nom</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nom du client" value="{{$client->nom}}">
                                        @error('nom')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="">Téléphone</label>
                                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" placeholder="Telephone du client" value="{{$client->telephone}}">
                                        @error('telephone')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="col-4">
                                        <label for="">Adresse</label>
                                        <textarea class="form-control @error('adresse') is-invalid @enderror" name="adresse" cols="15" rows="10" placeholder="Adresse du client">{{$client->adresse}}</textarea>
                                        @error('adresse')
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