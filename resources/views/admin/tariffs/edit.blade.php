@extends('admin.layouts.app')
@section('title')
    Tariffs
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Tariffs" parent="" parent-icon="" parent-route="admin.tariffs.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.tariffs.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.tariffs.form')
            </form>
        </div>
    </div>
@endsection
