@extends('admin.layouts.app')
@section('title')
    Klinikalar
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="Klinikalar"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.polyclinics.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Qo'shish</a>
    </div>

    @livewire('polyclinic.polyclinic-table')
    {{-- use livewire table here --}}
@endsection
