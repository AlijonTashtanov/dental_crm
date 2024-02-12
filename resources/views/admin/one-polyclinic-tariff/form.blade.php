@php
    use App\Models\Tariff;
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <input type="hidden" name="polyclinic_id" value="{{$polyclinic->id}}">
            <div class="form-group">
                <label for="exampleSelectBorder">Obuna turi</label>
                <select class="custom-select form-control" id="exampleSelectBorder" name="tariff_id">
                    @foreach(Tariff::map() as $key => $tariff)
                        <option
                                value="{{old("tariff_id") ? $response->tariff_id : $tariff->id}}" {{$response->tariff_id == $tariff->id ? 'selected' : ''}}>{{$tariff->getTranslation('name','uz')}}
                            - {{$tariff->max_doctor_count}} ta - {{decimal($tariff->price)}} so'm
                        </option>
                    @endforeach
                </select>
            </div>
            @error('tariff_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

@error('name')
<span class="text-danger">{{$message}}</span>
@enderror
<a href="{{route('admin.one-polyclinic-tariff.index',$polyclinic->id)}}" class="btn btn-secondary right">Bekor
    qilish</a>

<button type="submit" class="btn btn-primary float-right">Saqlash!</button>


