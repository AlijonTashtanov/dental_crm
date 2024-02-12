@extends('admin.layouts.app')
@section('title')
    {{$response->name}}
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="{{$response->name}}" parent="Klinikalar" parent-icon="" parent-route="admin.polyclinics.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.polyclinics.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.polyclinics.form')
            </form>
        </div>
    </div>
@endsection
