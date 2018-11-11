<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PageRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'max:5',
        ];
    }

    public function messages(){
        return [
            'required' => 'Поле :attribute обязательно к заполнению!',
            'name.required' => 'Поле :attribute обязательно к заполнению!', //only for name
            'max' => 'Телефон должен быть не более :max символов',
        ];
    }
}
