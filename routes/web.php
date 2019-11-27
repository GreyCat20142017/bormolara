<?php

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function () {
        return view('welcome');
    })->name('main');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('course', 'CourseController');
    Route::resource('word', 'WordController')->except(['index', 'create', 'store']);
    Route::get('/words/course/{course}/', 'WordController@indexByParent')->name('word.indexByParent');
    Route::get('/word/create/course/{course}', 'WordController@createByParent')->name('word.createByParent');
    Route::post('/word/course/{course}', 'WordController@storeByParent')->name('word.storeByParent');


    Route::resource('section', 'SectionController');
    Route::resource('phrase', 'PhraseController')->except(['index', 'create', 'store']);
    Route::get('/section/{section}/phrases', 'PhraseController@indexByParent')->name('phrase.indexByParent');
    Route::get('/section/{section}/phrase/create', 'PhraseController@createByParent')->name('phrase.createByParent');
    Route::post('/section/{section}/phrase', 'PhraseController@storeByParent')->name('phrase.storeByParent');

