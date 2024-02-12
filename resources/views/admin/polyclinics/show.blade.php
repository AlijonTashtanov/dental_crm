@extends('admin.layouts.app')
@section('title')
    {{$response->name}}
@endsection

@section('content')
    <x-headers title="{{$response->name}}" icon="fas fa-circle" parent="Klinikalar"
               parent-route="admin.polyclinics.index"
               parent-icon=""/>

    @include('admin.polyclinics.tab-menu')

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
                    <th>Telefon raqami</th>
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
                    <th>Balans</th>
                    <td>{{ $response->balanceFormatSum()}}</td>
                </tr>
                <tr>
                    <th>Holati</th>
                    <td>{!!   $response->getStatusBadgeName()  !!}</td>
                </tr>

            </table>
        </div>
    </div>
@endsection
