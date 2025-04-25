@extends('layouts.app')
@section('title')
    Modifier un utilisateur
@endsection
@section('content')
<div class="row layout-top-spacing">
<div class="col">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                    <h4>Modifier l'utilisateur</h4>
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{route('user.update', $user->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-4">
                                    <label for="">Nom</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nom" value="{{$user->nom}}">
                                    @error('nom')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="">Prénom</label>
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" placeholder="Prenom" value="{{$user->prenom}}">
                                    @error('prenom')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div> 
                                <div class="form-group mb-4">
                                    <label for="">Sexe</label>
                                    <select class="form-control @error('sexe') is-invalid @enderror" name="sexe">
                                        <option value="{{$user->sexe}}">{{$user->sexe}}</option>
                                        <option value="">Choisir</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                    @error('sexe')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div> 
                                <div class="form-group mb-4">
                                    <label for="">Téléphone</label>
                                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" placeholder="Téléphone" value="{{$user->telephone}}">
                                    @error('telephone')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div> 
                                <div class="form-group mb-4">
                                    <label for="">Email</label>
                                    <input type="mail" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{$user->email}}">
                                    @error('email')
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