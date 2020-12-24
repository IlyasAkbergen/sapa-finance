<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ScoreHomeworkRequest extends FormRequest
{
    protected $errorBag = 'userForm';
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
            'score.required' => 'Укажите оценку',
            'score.integer' => 'Значение оценки должно быть числовым',
            'score.max' => 'Максимальный значение оценки: 100'
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
            'homework_id' => ['required', 'exists:homeworks'],
            'score' => ['required', 'integer', 'max:100'],
        ];
    }
}
