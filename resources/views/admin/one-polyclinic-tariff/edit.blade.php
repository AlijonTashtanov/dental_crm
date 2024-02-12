@extends('admin.layouts.app')
@section('title')
    {{$polyclinic->name}}
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title=" {{$polyclinic->name}}" parent="Klinikalar" parent-icon=""
               parent-route="admin.polyclinics.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.one-polyclinic-payment.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.one-polyclinic-tariff.form')
            </form>
        </div>
    </div>
@endsection
