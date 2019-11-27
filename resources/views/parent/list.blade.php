@extends('layouts.app')
@section('content')
    <h3>{{$title ?? 'Список'}}</h3>
    <table class="table-bordered w-100 text-center">
        <thead>
        <tr class="bg-info text-dark">
            <th>id</th>
            <th>название</th>
            <th></th>
            <th></th>
            <th></th>
            @if (!empty($childName))
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($rows as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td><a class='btn btn-link' href='{{route($modelName . '.show', $row)}}'>просмотр</a></td>
                <td><a class='btn btn-link' href='{{route($modelName . '.edit', $row)}}'>изменение</a></td>
                <td>
                    @include('common.delete', ['route' => $modelName . '.destroy', 'row' => $row])
                </td>
                @if (!empty($childName))
                    <td><a class='btn btn-link'
                           href='{{route($childName . '.indexByParent', [$modelName => $row])}}'>список</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{$rows->links()}}
    </div>
    <hr/>
    @include('common.postTableButtons', ['modelName' => $modelName])
@endsection
