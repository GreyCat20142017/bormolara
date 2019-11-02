@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!

                        <hr/>
                        <ul class="list-unstyled">
                            <li><a href={{route('course.index')}}>Список курсов</a></li>
                            <li><a href={{route('section.index')}}>Список разделов</a></li>
                            <li><hr/></li>
                            <li><a href={{route('word.index')}}>Список слов</a></li>
                            <li><a href={{route('phrase.index')}}>Список фраз</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
