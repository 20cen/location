@extends('layouts.app')
@section('title')
    Type de tarification
@endsection
@section('content')

<div class="row layout-top-spacing">
    <div class="col">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="col-6">
                    <h4>Les types de tarification</h4>
                    <div class="table-responsive">
                        <table class="table table-stripped table-hovered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Types</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $type)
                                    <tr>
                                        <td>{{$type->id}}</td>
                                        <td>par {{$type->type}}</td>
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
@endsection