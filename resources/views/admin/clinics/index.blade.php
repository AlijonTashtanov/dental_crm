@extends('admin.layouts.app')
@section('title')
    Kilinikalar
@endsection
@section('content')
    <x-header icon="fas fa-circle" title="Kilinikalar"/>
    <div class="d-flex justify-content-end py-2">
        <a href="{{route('admin.clinics.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Qo'shish</a>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <x-search/>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Nomi</th>
                        <th>Tel</th>
                        <th>Manzili</th>
                        <th>Viloyat</th>
                        <th>Holati</th>
                        <th>Actions</th>
                    </tr>
                    @forelse($clinics as $clinic)
                        <tr>

                            <td>{{ (($clinics->currentpage()-1)*$clinics->perpage()+($loop->index+1)) }}</td>
                            <td>{{$clinic->name}}</td>
                            <td>{{$clinic->phone}}</td>
                            <td>{{$clinic->address}}</td>
                            <td>{{$clinic->region}}</td>
                            <td>{{$clinic->getStatus()}}</td>

                            <td>
                                <a href="{{route('admin.clinics.show', $clinic->id)}}" class="btn btn-primary"><i
                                        class="fas fa-eye"></i> Batafsil</a>
                                <a href="{{route('admin.clinics.edit', $clinic->id)}}" class="btn btn-success"><i
                                        class="fas fa-pencil-alt"></i> Tahrirlash</a>
                                <form action="{{route('admin.clinics.destroy', $clinic->id)}}" method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> O'chirish
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No data found :(</td>
                        </tr>
                    @endforelse
                </table>
                <div class="d-flex justify-content-between py-3">
                    {{$clinics->links()}}
                </div>
            </div>
        </div>
    </div>


@endsection
