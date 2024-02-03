@extends('admin.layouts.app')
@section('title')
    {{$response->getTranslation('name','uz')}}
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="{{$response->getTranslation('name','uz')}}" parent="Viloyatlar"
               parent-icon="" parent-route="admin.regions.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.regions.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.regions.form')
            </form>
        </div>
    </div>
@endsection
