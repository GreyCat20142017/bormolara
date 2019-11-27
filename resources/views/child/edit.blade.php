@extends("layouts.app")

@section("content")
    <form action="{{route($modelName . '.update', [$modelName => $row])}}" method="POST">
        @csrf
        @method("PATCH")
        <h5>{{$title ?? 'Изменение элемента'}}</h5>
        @include("child.element", ["readonly" => false])
        <div class="btn-group mt-3">
            <button class="btn btn-primary btn-sm">сохранить</button>
            <a class="btn btn-primary btn-sm ml-1" href="{{url()->previous()}}">отмена</a>
        </div>
    </form>
@endsection
