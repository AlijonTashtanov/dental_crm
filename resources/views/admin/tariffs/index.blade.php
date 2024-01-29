@extends('admin.layouts.app')
@section('title')
    Obunalar
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="Obunalar"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.tariffs.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Qo'shish</a>
    </div>
    @livewire('tariff.tariff-table')
    {{-- use livewire table here --}}
@endsection
