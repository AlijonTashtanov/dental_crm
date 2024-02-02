@extends('admin.layouts.app')
@section('title')
    Services
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Services" parent="" parent-icon="" parent-route="admin.services.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.services.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.services.form')
            </form>
        </div>
    </div>
@endsection
