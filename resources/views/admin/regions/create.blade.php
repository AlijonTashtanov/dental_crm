@extends('admin.layouts.app')
@section('title')
    Qo'shish
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title=" Qo'shish" parent="Viloyatlar" parent-icon="" parent-route="admin.regions.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.regions.store')}}" method="POST">
                @csrf
                @include('admin.regions.form')
            </form>
        </div>
    </div>
@endsection
