<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Phrase;

class PhraseRequest extends FormRequest
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
            'english' => ['required', 'string', 'max:255'],
            'russian' => ['required', 'string', 'max:255'],
            'user_id' => ['required', Rule::in([auth()->id()])]
        ];
    }
    public function attributes()
    {
        return [
            'english' => 'Английский',
            'russian' => 'Русский',
            'user_id' => 'Id пользователя'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле ":attribute" необходимо заполнить',
            'min'  => 'Поле ":attribute" должно быть длиной не менее :min',
            'max'  => 'Поле ":attribute" должно быть длиной не более :max',
            'in' => 'Можно изменять только собственные фразы'
        ];
    }
}
