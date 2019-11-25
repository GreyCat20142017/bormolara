{{-- Шаблон для вывода результатов ->paginate() типа LengthAwarePaginator--}}
{{-- В качестве параметра fields нужно передать массив с именами полей для вывода --}}

@extends('layouts.app')

@section('content')
    @if (!empty($rows))
        <table class="table table-hover table-bordered table-condensed table-responsive-md">
            <caption style="caption-side: top;">
                {{$title ?? ''}}
            </caption>
            <thead class="thead-light">
            <tr>
                @foreach($fields as $field)
                    <th class="text-center" style="vertical-align: middle;"> {{ trans('fields.' . $field) }}</th>
                @endforeach
                @include('crud.parts.table_buttons_headers')
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr>
                    @foreach($fields as $field)
                        <td>
                            {{ $row[$field] ?? '' }}
                        </td>
                    @endforeach
                    @include('crud.parts.table_buttons')
                </tr>
            @endforeach
            </tbody>
        </table>
        <p><small>{{ $comment ?? '' }}</small></p>
        {{$rows->appends(request()->query())->links()}}
        <hr/>
        @include('crud.parts.post_table_buttons')
    @else
        <h4>Нет данных для формирования страницы с такими условиями</h4>
    @endif
    @include ('common.flashMessages')
@endsection
