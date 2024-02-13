@extends('admin.layouts.app')
@section('title')
    Settings
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Settings" parent="" parent-icon="" parent-route="admin.settings.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.settings.store')}}" method="POST">
                @csrf
                @include('admin.settings.form')
            </form>
        </div>
    </div>
@endsection
