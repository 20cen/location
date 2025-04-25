@extends('layouts.app')
@section('title')
    Locations remises
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
                        <h4>Historiques</h4>
                        <div class="col-4">
                            <div>
                                <p>Annuler la remise en stock</p>
                                <form method="POST" action="{{route('historique.activate')}}">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <input type="number" class="form-control @error('id') is-invalid @enderror" name="id" placeholder="ID location">
                                        @error('id')
                                        <span class="invalid-feedback">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </div>                     
                                    
                                    <input type="submit" name="time" class="mt-0 mb-4 btn btn-primary" value="Sauvegarder">
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="users-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID location</th>
                                        <th>Matériel</th>
                                        <th>Client</th>
                                        <th>Nombre</th>
                                        <th>Date prise</th>
                                        <th>Date remise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($locations as $location)
                                        <tr>
                                            <td>{{$location->id}}</td>                                            
                                            <td>{{$location->materiels->nom}}</td>
                                            <td>{{$location->clients->nom}}</td>
                                            <td>{{$location->nombre}}</td>
                                            <td>{{$location->created_at}}</td>
                                            <td>{{$location->updated_at}}</td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID location</th>
                                        <th>Matériel</th>
                                        <th>Client</th>
                                        <th>Nombre</th>
                                        <th>Date prise</th>
                                        <th>Date remise</th>
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