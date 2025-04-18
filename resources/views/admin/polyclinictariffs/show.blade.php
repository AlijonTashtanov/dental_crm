@extends('admin.layouts.app')
@section('title')
    PolyclinicTariffs
@endsection
@section('content')
    <x-headers title="PolyclinicTariffs" icon="fas fa-circle" parent="parent" parent-route="admin.polyclinictariffs.index"
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
            </table>
        </div>
    </div>
@endsection
