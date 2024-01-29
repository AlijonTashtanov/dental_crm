<div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input type="text" class="form-control" id="nameInput" name="name"
           value="{{old("name") ?? $response->name}}">
</div>
@error('name')
<span class="text-danger">{{$message}}</span>
@enderror
<button type="submit" class="btn btn-primary float-right">Save!</button>
