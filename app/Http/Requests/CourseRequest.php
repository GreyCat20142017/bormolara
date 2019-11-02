<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Course;

class CourseRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:10'],
            'hidden' => ['integer', 'min:1', 'max:1']
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Название',
            'hidden' => 'Скрытый'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле ":attribute" необходимо заполнить',
            'min'  => 'Поле ":attribute" должно быть длиной не менее :min',
            'max'  => 'Поле ":attribute" должно быть длиной не более :max'
        ];
    }
}
