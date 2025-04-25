@extends('layouts.app')
@section('title')
    Les matériels
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('resources/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/plugins/table/datatable/dt-global_style.css')}}">
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Les matériels</h4>
                        <a href="{{route('materiel.create')}}" class="btn btn-primary">Ajouter d'un matériel</a>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="users-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Détails</th>
                                        <th>catégorie</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($materiels as $materiel)
                                    <tr>
                                        <td>{{$materiel->nom}}</td>
                                        <td>{{$materiel->details}}</td>
                                        <td>{{$materiel->categories->nom}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    @can('materiel.edit')
                                                        <a href="{{route('materiel.edit',$materiel->id)}}" class="dropdown-materiel">Modifier</a>
                                                    @endcan
                                                    @can('materiel.destroy')
                                                        <a class="a-del dropdown-item" href="#">Supprimer</a>
                                                        <form class="f-del d-none" action="{{route('materiel.destroy',$meteriel->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit">
                                                        </form>
                                                    @endcan
                                                </div>
                                              </div>
                                        </td>
                                    </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Détails</th>
                                        <th>catégorie</th>
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