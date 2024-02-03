<div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input type="text" class="form-control" id="nameInput" name="name"
           value="{{old("name") ?? $response->name}}">

    <label for="nameInput" class="form-label">Telefon raqami</label>
    <input type="text" class="form-control" id="nameInput" name="phone"
           value="{{old("phone") ?? $response->phone}}">

    <label for="nameInput" class="form-label">Manzili</label>
    <input type="text" class="form-control" id="nameInput" name="adress"
           value="{{old("name") ?? $response->address}}">

    <label for="nameInput" class="form-label">Viloyat</label>
    <select class="form-control" >
        @foreach(\App\Models\Region::all() as $region)
            <option  {{$region->id == $response->region->id ? 'selected' : ''}} >{{ $region->getTranslation('name', 'uz' )}}</option>
        @endforeach
    </select>

    <label for="nameInput" class="form-label">Holati</label>
    <select class="form-control" >
        <option {{$response->active == $response->status ? 'selected' : ''}} > Faol </option>
        <option {{$response->inactive == $response->status ? 'selected' : ''}} > Nofaol </option>
        <option {{$response->waiting == $response->status ? 'selected' : ''}} > Kutish holatida </option>
    </select>

</div>
@error('name')
<span class="text-danger">{{$message}}</span>
@enderror
<button type="submit" class="btn btn-primary float-right">Save!</button>
