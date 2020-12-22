<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MessageFormRequest extends FormRequest
{
    protected $errorBag = 'messageForm';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function messages()
    {
        return [
            'text.required' => 'Укажите название',
            'content.required' => ['Укажите описание урока'],
            'levels.required' => ['Не указаны получатели'],
            'levels.filled' => ['Не указаны получатели']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'levels' => ['required', 'array', 'filled']
        ];
    }
}
