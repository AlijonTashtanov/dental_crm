@extends('admin.layouts.app')
@section('title')
    PolyclinicTariffs
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="PolyclinicTariffs" parent="" parent-icon="" parent-route="admin.polyclinictariffs.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.polyclinictariffs.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.polyclinictariffs.form')
            </form>
        </div>
    </div>
@endsection
