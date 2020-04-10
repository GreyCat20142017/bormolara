<?php

Route::middleware(['cors'])->group(function () {
    Route::get('/courses/{course?}/{lesson?}/{offline?}', 'API\CourseController@courses')->name('courses');
    Route::get('/sections/{section?}/{lesson?}/{offline?}', 'API\SectionController@sections')->name('sections');

    Route::prefix('search')->group(function () {
        Route::get('/words/{word?}/{exact?}', 'API\SearchController@searchWords');
        Route::get('/phrases/{phrase?}/{exact?}', 'API\SearchController@searchPhrases');
    });
});

Route::middleware(['json.response', 'cors'])->group(function () {
    Route::post('/login', 'API\AuthController@login')->name('login.api');
    Route::post('/register', 'API\AuthController@register')->name('register.api');
});

Route::middleware(['auth:api', 'json.response', 'cors'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', 'API\UserController@getUserInfo')->name('info.api');
    Route::get('/logout', 'API\AuthController@logout')->name('logout.api');
    Route::post('/update', 'API\AuthController@update')->name('update.api');
    Route::get('/courses/{course?}/{lesson?}/{offline?}', 'API\CourseController@courses')->name('courses.api');
    Route::get('/sections/{section?}/{lesson?}/{offline?}', 'API\SectionController@sections')->name('sections.api');

    Route::post('/word/create', 'API\WordController@store')->name('word.add.api');
    Route::post('/phrase/create', 'API\PhraseController@store')->name('phrase.add.api');
});
