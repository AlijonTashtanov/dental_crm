@extends('admin.layouts.app')
@section('title')
    {{$response->name}}
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="{{$response->name}}" parent="Klinikalar"
               parent-route="admin.polyclinics.index" parent-icon=""/>
    @include('admin.polyclinics.tab-menu')
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.one-polyclinic-payment.create',$response->id)}}" class="btn btn-primary"><i
                class="fas fa-plus"></i>
            Qo'shish</a>
    </div>
    @livewire('polyclinic.payment-table',['polyclinicId' => $response->id])

    <h2>Jami to'lovlar: {{$response->balanceFormatSum()}}</h2>
@endsection
