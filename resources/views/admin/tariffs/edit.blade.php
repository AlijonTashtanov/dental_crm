@extends('admin.layouts.app')
@section('title')
    {{$response->getTranslation('name','uz')}}
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="{{$response->getTranslation('name','uz')}}" parent="Obunalar" parent-icon=""
               parent-route="admin.tariffs.index"/>
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
