@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Списки</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Выполнен вход под пользователем <strong>{{auth()->user()->name}}</strong>

                        <hr/>
                        <h5>Работа с данными для Бормотунчика</h5>
                        <ul class="list-unstyled">
                            <li><a href={{route('course.index')}}>Список курсов (лексика)</a></li>
                            <li><a href={{route('section.index')}}>Список курсов (фразы)</a></li>
                        </ul>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
