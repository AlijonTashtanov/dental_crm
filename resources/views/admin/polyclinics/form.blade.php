@php
    use App\Models\Region;
@endphp
<div class="mb-3">
    <div class="form-group">
        <label for="nameInput" class="form-label">Kinika nomi</label>
        <input type="text" class="form-control" id="nameInput" name="name"
               value="{{old("name") ?? $response->name}}">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nameInput" class="form-label">Telefon raqami</label>
        <input type="text" class="form-control mask-phone" id="nameInput" name="phone"
               value="{{old("phone") ?? $response->phone}}" placeholder="(91) 670-06-07">
        @error('phone')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nameInput" class="form-label">Manzili</label>
        <input type="text" class="form-control" id="nameInput" name="address"
               value="{{old("name") ?? $response->address}}">
        @error('address')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nameInput" class="form-label">Viloyat</label>
        <select class="form-control">
            @foreach(Region::all() as $region)
                <option
                    {{$response->region ? $region->id == $response->region->id ? 'selected' : '' : ''}} value="{{$region->id}}">{{ $region->getTranslation('name', 'uz' )}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nameInput" class="form-label">Holati</label>
        <select class="form-control">
            <option {{$response->active == $response->status ? 'selected' : ''}} > Faol</option>
            <option {{$response->inactive == $response->status ? 'selected' : ''}} > Nofaol</option>
            {{--        <option {{$response->waiting == $response->status ? 'selected' : ''}} > Kutish holatida </option>--}}
        </select>
    </div>
</div>
<button type="submit" class="btn btn-primary float-right">Saqlash!</button>

@push('scripts')
    <script>
        const elementMaskPhone = document.querySelector('.mask-phone');
        console.log(elementMaskPhone)
        const maskOptionsPhone = {
            mask: '(00) 000-00-00'
        };
        const maskPhone = IMask(elementMaskPhone, maskOptionsPhone);
    </script>
@endpush
