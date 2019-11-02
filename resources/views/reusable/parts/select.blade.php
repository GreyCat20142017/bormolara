<div>
    <label for="{{$field}}">{{trans('fields.' . $field)}}:</label>
    <select class="md-form mx-auto m-2 p-2 form-control @if ($errors->has($field)) is-invalid @endif"
            name="{{$field}}">
        <option value="" disabled @if (empty(old($field))) selected @endif>Выберите одно из значений:</option>
        @foreach($values as $value)
            <option value={{$value}} @if (old($field) === $value) selected @endif>{{$value}}</option>
        @endforeach
    </select>
    @if ($errors->has($field))
        <span class="text-danger"> {{ $errors->first($field) }}</span>
    @endif
</div>
