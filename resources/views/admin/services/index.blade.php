@extends('admin.layouts.app')
@section('title')
    Services
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="Services"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.services.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
    </div>
    {{-- use livewire table here --}}
@endsection
