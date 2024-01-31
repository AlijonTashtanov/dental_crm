@extends('admin.layouts.app')
@section('title')
    Viloyatlar
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="Viloyatlar"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.regions.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Qo'shish</a>
    </div>
    @livewire('region.region-table')
    {{-- use livewire table here --}}
@endsection
