@extends('layouts.app')
@section('title')
    Pertes
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('resources/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/plugins/table/datatable/dt-global_style.css')}}">
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col-4 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Ajouter une perte</h4>
                    </div>
                </div>
            </div>
            <div>
                <form method="POST" action="{{route('perte.store')}}">
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
                        <label for="">Nombre</label>
                        <input type="tel" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Quantité">
                        @error('nombre')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                        @enderror
                    </div>   
                    <div class="form-group mb-4">
                        <label for="">Détails</label>
                        <textarea class="form-control @error('details') is-invalid @enderror" name="details" cols="15" rows="10" placeholder="Détails du client"></textarea>
                        @error('details')
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
                        <h4>Les pertes</h4>
                        <div class="table-responsive">
                            <table id="users-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Matériel</th>
                                        <th>Nombre</th>
                                        <th>Détails</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pertes as $perte)
                                        <tr>
                                            <td>{{$perte->id}}</td>
                                            <td>{{$perte->materiels->nom}}</td>
                                            <td>{{$perte->nombre}}</td>
                                            <td>{{$perte->details}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            {{-- <form class="f-del" action="{{route('perte.edit', $perte->id)}}" method="GET">
                                                                <input type="submit" class="dropdown-item" value="Modifier">
                                                            </form> --}}
                                                            <form class="f-del" action="{{route('perte.destroy',$perte->id)}}" method="POST">
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
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Matériel</th>
                                        <th>Nombre</th>
                                        <th>Détails</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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