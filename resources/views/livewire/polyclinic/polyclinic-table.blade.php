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
                    <th>Telefon raqami</th>
                    <th>Manzili</th>
                    <th>Viloyat</th>
                    <th>Balans</th>
                    <th>Holati</th>
                    <th>Sozlamalar</th>
                </tr>
                @forelse($items as $item)
         
                    <tr>
                        <td>{{ (($items->currentpage()-1)*$items->perpage()+($loop->index+1)) }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{ $item->region->getTranslation('name', 'uz' )}}</td>
                        <td>{{$item->balanceFormatSum()}}</td>
                        <td>
                            <p style="border-radius: 20px"> {!!   $item->getStatusBadgeName()  !!}</p>
                        </td>

                        <td>
                            <a href="{{route('admin.'.$this->route.'.show', $item->id)}}" class="btn btn-primary"><i
                                    class="fas fa-eye"></i> Batafsil</a>
                            <a href="{{route('admin.'.$this->route.'.edit', $item->id)}}" class="btn btn-success"><i
                                    class="fas fa-pencil-alt"></i> Tahrirlash</a>
                            {{--                            <form action="{{route('admin.'.$this->route.'.destroy', $item->id)}}" method="POST"--}}
                            {{--                                  class="d-inline-block">--}}
                            {{--                                @csrf--}}
                            {{--                                @method('DELETE')--}}
                            {{--                                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">--}}
                            {{--                                    <i class="fas fa-trash"></i> O'chirish--}}
                            {{--                                </button>--}}
                            {{--                            </form>--}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No data found :(</td>
                    </tr>
                @endforelse
            </table>
            <div class="d-flex justify-content-between py-3">
                <div>
                    <select class="form-control form-select" id="pagination" wire:model="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                {{$items->links()}}
            </div>
        </div>
    </div>
</div>
