@extends('admin.layouts.app')
@section('title')
    Staff
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="Staff" parent="" parent-icon="" parent-route="admin.staff.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.staff.store')}}" method="POST">
                @csrf
                @include('admin.staff.form')
            </form>
        </div>
    </div>
@endsection
