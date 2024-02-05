@extends('admin.layouts.app')
@section('title')
    Diseases
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Diseases" parent="" parent-icon="" parent-route="admin.diseases.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.diseases.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.diseases.form')
            </form>
        </div>
    </div>
@endsection
