@extends('admin.layouts.app')
@section('title')
    PolyclinicPayments
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="PolyclinicPayments"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.polyclinicpayments.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
    </div>
    {{-- use livewire table here --}}
@endsection
