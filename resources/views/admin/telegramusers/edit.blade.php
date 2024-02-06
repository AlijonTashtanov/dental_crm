@extends('admin.layouts.app')
@section('title')
    TelegramUsers
@endsection
@section('content')
    <x-headers icon="fas fa-circle" title="TelegramUsers" parent="" parent-icon="" parent-route="admin.telegramusers.index"/>
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.telegramusers.update', $response->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.telegramusers.form')
            </form>
        </div>
    </div>
@endsection
