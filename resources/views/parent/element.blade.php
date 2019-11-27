<div>
    <label class="mb-0 mt-2" for="name">id</label>
    <input class="form-control  @if ($errors->has('id')) is-invalid @endif"
           type="text" id="id" name="id"
           value="{{old("id") ?? (isset($row) ? $row->id : null)}}" required readonly>
    @if ($errors->has("id"))
        <span class="text-danger"> {{ $errors->first("id") }}</span>
    @endif
</div>

<div>
    <label class="mb-0 mt-2" for="name">название</label>
    <input class="form-control  @if ($errors->has('name')) is-invalid @endif"
           type="text" id="name" name="name"
           value="{{old("name") ?? (isset($row) ? $row->name : null)}}" required
           @if($readonly ?? false) readonly @endif>
    @if ($errors->has("name"))
        <span class="text-danger"> {{ $errors->first("name") }}</span>
    @endif
</div>
