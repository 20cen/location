@extends('layouts.app')
@section('title')
    Profil
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col-5 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Modifier mot de passe</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="#">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="">ID</label>
                        <input type="number" class="form-control @error('id') is-invalid @enderror" name="id" value="{{$user->id}}" disabled>
                        @error('id')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Ancien mot de passe</label>
                        <input type="password" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Ancien mot de passe">
                        @error('nom')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Nouveau mot de passe</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nouveau mot de passe">
                        @error('nom')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div> 
                    <div class="form-group mb-4">
                        <label for="">Confirmation nouveau mot de passe</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Confirmation nouveau mot de passe">
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
            <div class="widget widget-account-invoice-one">
    
                <div class="widget-heading">
                    <h5 class="">Profil</h5>
                </div>
    
                <div class="widget-content">
                    <div class="invoice-box">
                        
                        <div class="acc-total-info">
                            <h5>{{$user->nom}} {{$user->prenom}}</h5>
                            <p class="acc-amount">{{$user->sexe}}</p>
                        </div>
    
                        <div class="inv-detail">                                        
                            <div class="info-detail-1">
                                <p>Téléphone</p>
                                <p>{{$user->telephone}}</p>
                            </div>
                            <div class="info-detail-2">
                                <p>Email</p>
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
    
                        <div class="inv-action">
                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-danger">Modifier</a>
                        </div>
                    </div>
                </div>
    
            </div>
    </div>
</div>
@endsection