<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordRequest;
use App\Models\Course;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request) {
        $course = Course::where('id', intval($request->course_id))->first();

        if (!$course) {
            $response = ['error' => 'Курс с таким id не найден'];
            return response($response, 422);
        }

        if ($course->user_id !== $request->user()->id) {
            $response = ['error' => 'Нет возможности добавлять слова к чужим курсам'];
            return response($response, 422);
        }

        $word = Word::create($request->all());

        if (!$word) {
            $response = ['error' => 'Произошла ошибка при добавлении слова'];
            return response($response, 422);
        }

        $response = ['id' => $word->id];
        return response($response, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
