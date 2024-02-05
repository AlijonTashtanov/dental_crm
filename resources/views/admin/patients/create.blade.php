@extends('admin.layouts.app')
@section('title')
    Patients
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Patients" parent="" parent-icon="" parent-route="admin.patients.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.patients.store')}}" method="POST">
                @csrf
                @include('admin.patients.form')
            </form>
        </div>
    </div>
@endsection
