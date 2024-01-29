@extends('admin.layouts.app')
@section('title')
    Polyclinics
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Polyclinics" parent="" parent-icon="" parent-route="admin.polyclinics.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.polyclinics.store')}}" method="POST">
                @csrf
                @include('admin.polyclinics.form')
            </form>
        </div>
    </div>
@endsection
