<div class="mb-3">
    <div class="form-group">
        <label for="nameInput" class="form-label">Obuna nomi [uz]</label>
        <input type="text" class="form-control" id="nameInput" name="name_uz"
               value="{{old("name_uz") ?? $response->getTranslation('name','uz')}}">
        @error('name_uz')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nameInput" class="form-label">Obuna nomi [ru]</label>
        <input type="text" class="form-control" id="nameInput" name="name_ru"
               value="{{old("name_ru") ?? $response->getTranslation('name','ru')}}">
        @error('name_ru')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nameInput" class="form-label">Obuna nomi [en]</label>
        <input type="text" class="form-control" id="nameInput" name="name_en"
               value="{{old("name_en") ?? $response->getTranslation('name','en')}}">
        @error('name_en')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="nameInput" class="form-label">Narxi</label>
                <input type="text" class="form-control" id="nameInput" name="price"
                       value="{{old("price") ?? $response->price}}">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nameInput" class="form-label">Davomiyligi (Son)</label>
                <input type="text" class="form-control" id="nameInput" name="duration_number"
                       value="{{old("duration_number") ?? $response->duration_number}}">
                @error('duration_number')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nameInput" class="form-label">Davomiylik qiymati</label>
                <select class="custom-select" name="duration_text">
                    @foreach(\App\Models\Tariff::durationTexts() as $key=>$durationText)
                        <option value="{{$key}}">{{$durationText}}</option>
                    @endforeach
                </select>
                @error('duration_text')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nameInput" class="form-label">Ruxsat berilgan dokotlar soni (max)</label>
                <input type="number" class="form-control" id="nameInput" name="max_doctor_count"
                       value="{{old("max_doctor_count") ?? $response->max_doctor_count}}">
                @error('max_doctor_count')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
{{--    <div class="form-group">--}}
{{--        <div class="custom-control custom-checkbox">--}}
{{--            <input class="custom-control-input" type="checkbox"--}}
{{--                   id="customCheckbox2" name="is_free"--}}
{{--                   {{$response->is_free== 1 ? 'checked' : 0 }} value="{{$response->is_free== 1 ? 'checked' : 0 }}">--}}
{{--            <label for="customCheckbox2" class="custom-control-label">Bepul sifatida belgilash</label>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group">
        <div class="bootstrap-switch-on bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate"
             style="width: 120px;">
            <div class="bootstrap-switch-container" style="width: 250px; margin-left: 0px;">
                <input type="checkbox" name="status" data-bootstrap-switch="" data-off-color="danger"
                       data-off-text="Nofaol"
                       data-on-color="success" data-on-text="Faol"
                       {{$response->isChecked()}} value="{{$response->isChecked() ? 1 :0}}">
            </div>
        </div>
    </div>
</div>
@error('name')
<span class="text-danger">{{$message}}</span>
@enderror
<button type="submit" class="btn btn-primary float-right">Saqlash!</button>

@push('scripts')
    <script>
        $(function () {
            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        })
    </script>
@endpush
