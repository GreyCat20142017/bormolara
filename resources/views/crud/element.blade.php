@extends('layouts.app')

@section('content')

    <form class="@if ($errors->any()) is-invalid @endif"
          @if (!empty($action)) action="{{route($resource . '.' . $action, ($needParam ?? false ) ? [$resource => $row] : null)}}"
          @endif
          method={{$method ?? 'GET'}}>
        @csrf
        @if (!empty($submethod))
            @method($submethod)
        @endif

        <h4 class="py-2 text-center">{{trans('crud.crud.' . $resource)}} : {{trans('crud.' . $action)}}</h4>
        <div>
            @foreach($fields as $field)
                @if (!empty($selects) && array_key_exists($field, $selects) && !empty($selects[$field]))
                    @include('crud.parts.select', ['values' => $selects[$field]['values'] ?? [], 'field' => $field])
                @else
                    <label for="{{$field}}">{{trans('fields.' . $field)}}:</label>
                    <input class="form-control  @if ($errors->has($field)) is-invalid @endif"
                           type="text" id={{$field}} name="{{$field}}"
                           value="{{old($field) ?? $row->getAttribute($field)}}" required
                           @if ((\Illuminate\Support\Str::endsWith($field, 'id')) || ($readonly ?? false)) readonly @endif/>
                    @if ($errors->has($field))
                        <span class="text-danger"> {{ $errors->first($field) }}</span>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="btn-group p-4 text-center w-100">
            @if (!($readonly ?? false))
                <button class="btn btn-sm btn-primary" type="submit">Сохранить</button>
            @endif
            <a class="btn btn-sm btn-primary ml-1" href="{{url()->previous()}}" type="button">Назад</a>
            <a class="btn btn-sm btn-primary ml-1" href="{{route($resource . '.index', request()->query())}}" type="button">Список</a>
        </div>

    </form>
@endsection
