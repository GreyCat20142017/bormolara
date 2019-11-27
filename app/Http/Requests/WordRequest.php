<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Word;

class WordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules() {
        return [
            'english' => ['required', 'string', 'max:32'],
            'russian' => ['required', 'string', 'max:160'],
        ];
    }
    public function attributes()
    {
        return [
            'english' => 'Английский',
            'russian' => 'Русский',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле ":attribute" необходимо заполнить',
            'min'  => 'Поле ":attribute" должно быть длиной не менее :min',
            'max'  => 'Поле ":attribute" должно быть длиной не более :max',
        ];
    }
}
