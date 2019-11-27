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
    <label class="mb-0 mt-2" for="english">английский</label>
    <input class="form-control  @if ($errors->has('english')) is-invalid @endif"
           type="text" id="english" name="english"
           value="{{old("english") ?? (isset($row) ? $row->english : null)}}" required
           @if($readonly ?? false) readonly @endif>
    @if ($errors->has("english"))
        <span class="text-danger"> {{ $errors->first("english") }}</span>
    @endif
</div>

<div>
    <label class="mb-0 mt-2" for="russian">русский</label>
    <input class="form-control  @if ($errors->has('russian')) is-invalid @endif"
           type="text" id="russian" name="russian"
           value="{{old("russian") ?? (isset($row) ? $row->russian : null)}}" required
           @if($readonly ?? false) readonly @endif>
    @if ($errors->has("russian"))
        <span class="text-danger"> {{ $errors->first("russian") }}</span>
    @endif
</div>
