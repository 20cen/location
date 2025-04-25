@extends('layouts.app')
@section('title')
    Utilisateurs
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col-4 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Ajouter un utilisateur</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{route('user.store')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Nom">
                        @error('nom')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Prénom</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" placeholder="Prenom">
                        @error('prenom')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div> 
                    <div class="form-group mb-4">
                        <label for="">Sexe</label>
                        <select class="form-control @error('sexe') is-invalid @enderror" name="sexe">
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
                        <input type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" placeholder="Téléphone">
                        @error('telephone')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div> 
                    <div class="form-group mb-4">
                        <label for="">Email</label>
                        <input type="mail" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div> 
                    <div class="form-group mb-4">
                        <label for="">Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe">
                        @error('password')
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
                        <h4>Les utilisateurs</h4>
                        <div class="table-responsive">
                            <table class="table table-stripped table-hovered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Sexe</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->nom}}</td>
                                            <td>{{$user->prenom}}</td>
                                            <td>{{$user->sexe}}</td>
                                            <td>{{$user->telephone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            <form class="f-del" action="{{route('user.edit', $user->id)}}" method="GET">
                                                                <input type="submit" class="dropdown-item" value="Modifier">
                                                            </form>
                                                            {{-- <form class="f-del" action="{{route('user.destroy',$user->id)}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="submit" class="dropdown-item" value="Supprimer">
                                                            </form> --}}
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