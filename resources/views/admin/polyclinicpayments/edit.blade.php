@extends('admin.layouts.app')
@section('title')
    PolyclinicPayments
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="PolyclinicPayments" parent="" parent-icon="" parent-route="admin.polyclinicpayments.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.polyclinicpayments.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.polyclinicpayments.form')
            </form>
        </div>
    </div>
@endsection
