@php
    use App\Models\PolyclinicPayment;
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <input type="hidden" value="{{$polyclinic->id}}" name="polyclinic_id">
            <label for="nameInput" class="form-label">To'lov miqdori</label>
            <input type="text" class="form-control" id="nameInput" name="amount"
                   value="{{old("amount") ?? $response->amount}}">
            @error('amount')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-group">
                <label for="exampleSelectBorder">To'lov turi</label>
                <select class="custom-select form-control" id="exampleSelectBorder" name="type_id">
                    @foreach(PolyclinicPayment::paymentTypes() as $key => $paymentType)
                        <option value="{{old("type_id") ? $response->type_id : $key}}" {{$response->type_id == $key ? 'selected' : ''}}>{{$paymentType}}</option>
                    @endforeach
                </select>
            </div>
            @error('type_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="commentInput" class="form-label">Izoh</label>
            <textarea id="commentInput" name="comment" rows="4" class="form-control">
                    {{old("comment") ?? $response->comment}}
            </textarea>
            @error('comment')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

@error('name')
<span class="text-danger">{{$message}}</span>
@enderror
<a href="{{route('admin.one-polyclinic-payment.index',$polyclinic->id)}}" class="btn btn-secondary right">Bekor
    qilish</a>

<button type="submit" class="btn btn-primary float-right">Saqlash!</button>


