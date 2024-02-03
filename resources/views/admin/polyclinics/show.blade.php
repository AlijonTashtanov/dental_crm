@extends('admin.layouts.app')
@section('title')
    Polyclinics
@endsection
@section('content')
    <x-headers title="Polyclinics" icon="fas fa-circle" parent="parent" parent-route="admin.polyclinics.index"
               parent-icon=""/>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                        class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{$response->id}}</td>
                </tr>
                <tr>
                    <th>Nomi</th>
                    <td>{{$response->name}}</td>
                </tr>
                <tr>
                    <th>Telefon raqami </th>
                    <td>{{$response->phone}}</td>
                </tr>
                <tr>
                    <th>Manzili</th>
                    <td>{{$response->address}}</td>
                </tr>
                <tr>
                    <th>Viloyati</th>
                    <td>{{ $response->region->getTranslation('name', 'uz' )}}</td>
                </tr>
                <tr>
                    <th>Holati</th>
                    <td>{{ $response->getStatus()  }}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection
