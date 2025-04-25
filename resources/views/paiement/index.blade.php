@extends('layouts.app')
@section('title')
    Paiements
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('resources/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/plugins/table/datatable/dt-global_style.css')}}">
@endsection
@section('content')

<div class="row layout-top-spacing">
    {{-- <div class="statbox widget box box-shadow">
        <div class="widget-header">                                
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Nouvelle location</h4>
                </div>
            </div>
        </div>
        <div>
            <form method="POST" action="{{route('paiement.store')}}">
                @csrf
                <div class="form-group mb-4">
                    <label for="">matériel</label>
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
                    <label for="">ID Client</label>
                    <input type="number" class="form-control @error('clients_id') is-invalid @enderror" name="clients_id" placeholder="ID du client">
                    @error('clients_id')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="">Nombre</label>
                    <input type="number" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Quantité">
                    @error('nombre')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                </div>                     
                
                <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary" value="Sauvegarder">
            </form>
        </div>
    </div> --}}
    <div class="statbox widget box box-shadow">
        <div class="widget-header">                                
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Les paiements</h4>
                    <div class="col-12">
                        <div>
                            <p>Ajout d'un paiement</p>
                            <form method="POST" action="{{route('paiement.store')}}">
                                @csrf
                                    <input type="number" class="form-group @error('locations_id') is-invalid @enderror" name="locations_id" placeholder="ID">
                                    @error('locations_id')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror

                                    <input type="number" class="form-group @error('montant') is-invalid @enderror" name="montant" placeholder="Montant">
                                    @error('montant')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror

                                    <select class="form-group @error('users_id') is-invalid @enderror" name="users_id" style="display: none;">
                                        <option value="{{Auth::user()->id}}">{{Auth::user()->nom}} {{Auth::user()->prenom}}</option>
                                    </select><br>
                                
                                <input type="submit" name="time" class="mt-0 mb-4 btn btn-primary" value="Sauvegarder">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="users-table" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Matériel</th>
                                    <th>Client</th>
                                    <th>Qté</th>
                                    <th>PU</th>
                                    <th>PU*Qté</th>
                                    <th>Durée</th>
                                    <th>PT</th>
                                    <th>Payé</th>
                                    <th>Reste</th>
                                    <th>Du</th>
                                    <th>Au</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                @forelse ($locations as $location)

                                @php
                                     $pu = \App\Http\Controllers\TarifController::findbymaterielid($location->materiels_id);
                                     $puqte = $location->nombre * $pu;
                                     $idtypep = \App\Http\Controllers\TarifController::findtypetarif($location->materiels_id);
                                     $payer = \App\Http\Controllers\PaiementController::montant($location->id);
                                     
                                     if ($location->etat == 'actif') {
                                         $duree = "En cours";
                                         $au = "";
                                         $pt = "";
                                         $reste = "";
                                     }else {

                                        //Heures
                                         if ($idtypep == 1) {
                                            $typep = \App\Models\Typelocation::find($idtypep)->type."(s)";
                                            $t1 = StrToTime ($location->updated_at);
                                            $t2 = StrToTime ($location->created_at);
                                            $dureetotale =(int)(($t1 - $t2)/ ( 60 * 60 ));                                            
                                            $duree =  $dureetotale." ".$typep;
                                            $pt = ($dureetotale * $puqte)." FCFA";
                                            $reste = (($dureetotale * $puqte) - $payer)." FCFA";

                                        //Jours
                                         } elseif ($idtypep == 2) {
                                            $typep = \App\Models\Typelocation::find($idtypep)->type."(s)";
                                            $date1 = date_format($location->created_at, "Y-m-d");
                                            $date2 = date_format($location->updated_at, "Y-m-d");
                                            $diff = date_diff(date_create($date1), date_create($date2));
                                            $dureetotale = (int)$diff->format("%a");
                                            $duree =  $dureetotale." ".$typep;
                                            $pt = ($dureetotale * $puqte)." FCFA";
                                            $reste = (($dureetotale * $puqte) - $payer)." FCFA";

                                        //Semaines
                                         } elseif ($idtypep == 3) {
                                            $typep = \App\Models\Typelocation::find($idtypep)->type."(s)";
                                            $date1 = new DateTime($location->created_at);
                                            $date2 = new DateTime($location->updated_at);
                                            $diff = $date2->diff($date1);
                                            $dureetotale = round(((($diff->d)+1)/7));
                                            $duree =  $dureetotale." ".$typep;
                                            $pt = ($dureetotale * $puqte)." FCFA";
                                            $reste = (($dureetotale * $puqte) - $payer)." FCFA";

                                        //Mois
                                         }else {
                                            $typep = \App\Models\Typelocation::find($idtypep)->type."(s)";
                                            $date1 = new DateTime($location->created_at);
                                            $date2 = new DateTime($location->updated_at);
                                            $diff = $date2->diff($date1);
                                            $dureetotale = round($diff->m);
                                            $duree =  $dureetotale." ".$typep;
                                            $pt = ($dureetotale * $puqte)." FCFA";
                                            $reste = (($dureetotale * $puqte) - $payer)." FCFA";
                                         }
                                         
                                         $au = date_format($location->updated_at, "d-m-Y H:i:s");                                        
                                         
                                     }
                                @endphp

                                    <tr>
                                        <td>{{$location->id}}</td>                                            
                                        <td>{{$location->materiels->nom}}</td>
                                        <td>{{$location->clients->nom}}</td>
                                        <td>{{$location->nombre}}</td>
                                        <td>{{$pu}} FCFA</td>
                                        <td>{{$puqte}} FCFA</td>
                                        <td>{{$duree}}</td>
                                        <td>{{$pt}}</td>
                                        <td>{{$payer}} FCFA</td>
                                        <td>{{$reste}}</td>
                                        <td>{{date_format($location->created_at, "d-m-Y H:i:s")}}</td>
                                        <td>{{$au}}</td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Matériel</th>
                                    <th>Client</th>
                                    <th>Qté</th>
                                    <th>PU</th>
                                    <th>PU*Qté</th>
                                    <th>Durée</th>
                                    <th>PT</th>
                                    <th>Avance</th>
                                    <th>Reste</th>
                                    <th>Du</th>
                                    <th>Au</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('resources/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $(function(){
            $('a.a-del').on('click',function(){
                    $('form.f-del').submit();
                return false;
            });

            $('#users-table').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        });
    </script>
@endsection