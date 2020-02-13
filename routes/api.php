<?php

    use Illuminate\Http\Request;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */


    Route::get('/courses/{course?}/{lesson?}/{offline?}', 'API\CourseController@courses')->name('courses');
    Route::get('/sections/{section?}/{lesson?}/{offline?}', 'API\SectionController@sections')->name('sections');


    Route::prefix('search')->group(function () {
        Route::get('/words/{word?}/{exact?}', 'API\SearchController@searchWords');
        Route::get('/phrases/{phrase?}/{exact?}', 'API\SearchController@searchPhrases');
    });



    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
