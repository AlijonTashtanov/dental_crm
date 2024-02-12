@extends('admin.layouts.app')
@section('title')
    << {{$polyclinic->name}} >> ga to'lov qo'shish
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="<<{{$polyclinic->name}}>>ga obuna qo'shish" parent="Klinikalar"
               parent-icon=""
               parent-route="admin.polyclinics.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.one-polyclinic-tariff.store')}}" method="POST">
                @csrf
                @include('admin.one-polyclinic-tariff.form')
            </form>
        </div>
    </div>
@endsection
