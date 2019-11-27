@extends("layouts.app")

@section("content")
    <form action="{{route($modelName . '.storeByParent', [$parentName => $parent])}}" method="POST">
        <h5>{{$title ?? 'Создание нового элемента'}}</h5>
        @csrf
        @include("child.element", ["readonly" => false])
        <div class="btn-group mt-3">
            <button class="btn btn-primary btn-sm" type="submit" name="save">сохранить</button>
            <button class="btn btn-primary btn-sm ml-1" type="submit" name="saveAndRepeat">сохранить и продолжить</button>
        </div>
    </form>
    <hr/>
    <a class="btn btn-primary btn-sm ml-1" href="{{route('word.indexByParent', [$parentName => $parent])}}">
        Вернуться в список
    </a>
@endsection
