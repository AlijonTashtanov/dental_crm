@extends('admin.layouts.app')
@section('title')
    Qo'shish
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Qo'shish" parent="Klinikalar" parent-icon=""
               parent-route="admin.polyclinics.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.polyclinics.store')}}" method="POST">
                @csrf
                @include('admin.polyclinics.form')
            </form>
        </div>
    </div>
@endsection
