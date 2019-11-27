@extends("layouts.app")

@section("content")
    <form action="{{route($modelName . '.store')}}" method="POST">
        <h5>{{$title ?? 'Создание нового элемента'}}</h5>
        @csrf
        @include("parent.element", ["readonly" => false])
        <div class="btn-group mt-3">
            <button class="btn btn-primary btn-sm" type="submit">сохранить</button>
            <a class="btn btn-primary btn-sm ml-1" href="{{url()->previous()}}">назад</a>
        </div>
    </form>
@endsection
