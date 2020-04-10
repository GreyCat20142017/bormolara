<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhraseRequest;
use App\Models\Phrase;
use App\Models\Section;
use Illuminate\Http\Request;

class PhraseController extends Controller
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
    public function store(PhraseRequest $request)
    {
        $section = Section::where('id', intval($request->section_id))->first();

        if (!$section) {
            $response = ['error' => 'Курс с таким id не найден'];
            return response($response, 422);
        }

        if ($section->user_id !== $request->user()->id) {
            $response = ['error' => 'Нет возможности добавлять слова к чужим курсам'];
            return response($response, 422);
        }

        $phrase = Phrase::create($request->all());

        if (!$phrase) {
            $response = ['error' => 'Произошла ошибка при добавлении слова'];
            return response($response, 422);
        }

        $response = ['id' => $phrase->id];
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
