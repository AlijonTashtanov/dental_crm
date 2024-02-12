<div>
    <div class="card">
        <div class="card-header">
            <x-search/>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>ID</th>
                    <th>Obuna nomi</th>
                    <th>Obuna narxi</th>
                    <th>Ruxsat berilgan Max doktorlar soni</th>
                    <th>Boshlanish sanasi</th>
                    <th>Tugash sanasi sanasi</th>
                    <th>Holati</th>
                    <th>Yaratildi</th>
                    <th>Tahrirlandi</th>
                    <th>Harakatlar</th>
                </tr>
                @forelse($items as $item)
                    <tr>
                        <td>{{ (($items->currentpage()-1)*$items->perpage()+($loop->index+1)) }}</td>
                        <td>{{$item->tariff?->getTranslation('name', 'uz')}}</td>
                        <td>{{decimal($item->price)}}</td>
                        <td>{{$item->max_doctor_count}}</td>
                        <td>{{$item->start_at}}</td>
                        <td>{{$item->expire_at}}</td>
                        <td>{!! $item->getStatusBadgeName()!!}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
{{--                            <a href="{{route('admin.'.$this->route.'.edit', $item->id)}}" class="btn btn-success"><i--}}
{{--                                    class="fas fa-pencil-alt"></i> Tahrirlash</a>--}}
                            <form action="{{route('admin.'.$this->route.'.destroy', $item->id)}}" method="POST"
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
                        <td colspan="10">No data found :(</td>
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
