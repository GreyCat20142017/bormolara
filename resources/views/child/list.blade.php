@extends('layouts.app')
@section('content')
    <h3>{{$title ?? 'Список'}}</h3>
    <table class="table-bordered w-100 text-center">
        <thead>
        <tr class="bg-primary text-white">
            <th>id</th>
            <th>английский</th>
            <th>русский</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($rows as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->english}}</td>
                <td>{{$row->russian}}</td>
                <td><a class='btn btn-link'
                       href='{{route($modelName . '.show', [$modelName => $row])}}'>просмотр</a>
                </td>
                <td><a class='btn btn-link' href='{{route($modelName . '.edit', [$modelName => $row])}}'>изменение</a>
                </td>
                <td>
                    @include('common.delete', ['route' => $modelName . '.destroy', [$modelName => $row]])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{$rows->links()}}
    </div>
    <hr/>
    <div class='btn-group'>
        <a class="btn btn-sm btn-primary mx-1"
           href="{{route($modelName . '.createByParent', [$parentName => ($parent ?? null)])}}">
            Создать {{trans('common.' . $modelName)}}
        </a>
        <a class="btn btn-sm btn-primary mx-1" href={{url()->previous()}}>Назад</a>
        <a class="btn btn-sm btn-primary mx-1" href={{route($parentName . '.index')}}>Cписок курсов</a>
    </div>
@endsection
