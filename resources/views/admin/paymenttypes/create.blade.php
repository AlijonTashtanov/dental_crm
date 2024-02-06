@extends('admin.layouts.app')
@section('title')
    PaymentTypes
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="PaymentTypes" parent="" parent-icon="" parent-route="admin.paymenttypes.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.paymenttypes.store')}}" method="POST">
                @csrf
                @include('admin.paymenttypes.form')
            </form>
        </div>
    </div>
@endsection
