@extends("layouts.app")

@section("content")
    <h5>{{$title ?? 'Просмотр элемента'}}</h5>
    @include("parent.element", ["readonly" => true])
    <div class="btn-group mt-3">
        <a class="btn btn-primary btn-sm" href="{{url()->previous()}}">назад</a>
    </div>
@endsection
