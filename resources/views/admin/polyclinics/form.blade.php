@php
    use App\Models\Region;
@endphp
<div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input type="text" class="form-control" id="nameInput" name="name" readonly
           value="{{old("name") ?? $response->name}}">
    @error('name')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <label for="nameInput" class="form-label">Telefon raqami</label>
    <input type="text" class="form-control" id="nameInput" name="phone"
           value="{{old("phone") ?? $response->phone}}" readonly>
    @error('phone')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <label for="nameInput" class="form-label">Manzili</label>
    <input type="text" class="form-control" id="nameInput" name="address"
           value="{{old("name") ?? $response->address}}">
    @error('address')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <label for="nameInput" class="form-label">Viloyat</label>
    <select class="form-control">
        @foreach(Region::all() as $region)
            <option {{$region->id == $response->region->id ? 'selected' : ''}} value="{{$region->id}}">{{ $region->getTranslation('name', 'uz' )}}</option>
        @endforeach
    </select>

    <label for="nameInput" class="form-label">Holati</label>
    <select class="form-control">
        <option {{$response->active == $response->status ? 'selected' : ''}} > Faol</option>
        <option {{$response->inactive == $response->status ? 'selected' : ''}} > Nofaol</option>
{{--        <option {{$response->waiting == $response->status ? 'selected' : ''}} > Kutish holatida </option>--}}
    </select>

</div>
<button type="submit" class="btn btn-primary float-right">Saqlash!</button>
