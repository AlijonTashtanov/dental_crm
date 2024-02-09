@extends('admin.layouts.app')
@section('title')
    {{$response->name}}
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="{{$response->name}}" parent="Klinikalar"
               parent-route="admin.polyclinics.index" parent-icon=""/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.one-polyclinic-payments.create',$response->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i>
            Create</a>
    </div>
    @include('admin.polyclinics.tab-menu')
    @livewire('polyclinic.payment-table',['polyclinicId' => $response->id])
@endsection
