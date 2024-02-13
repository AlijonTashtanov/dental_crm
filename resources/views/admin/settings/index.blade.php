@extends('admin.layouts.app')
@section('title')
    Settings
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="Settings"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.settings.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
    </div>
    @livewire('setting.setting-table')
    {{-- use livewire table here --}}
@endsection
