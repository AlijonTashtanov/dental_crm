@extends('admin.layouts.app')
@section('title')
    Categories
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Categories" parent="" parent-icon="" parent-route="admin.categories.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                @include('admin.categories.form')
            </form>
        </div>
    </div>
@endsection
