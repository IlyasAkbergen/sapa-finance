<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CourseRequest extends FormRequest
{
    protected $errorBag = 'courseForm';
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
            'title.required' => 'Укажите название',
            'short_description.required' => ['Укажите короткое описание'],
            'description.required' => ['Укажите полное описание'],
            'is_online.required' => [''],
            'price_without_feedback.required' => ['Укажите цену без обратной связи'],
            'price_without_feedback.integer' => ['Значение должно быть числовым'],
            'price_with_feedback.required' => ['Укажите цену с обратной связью'],
            'price_with_feedback.integer' => ['Значение должно быть числовым'],
            'direct_fee.required' => ['Укажите комиссию агента'],
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
            'short_description' => ['required', 'max:255'],
            'description' => ['required'],
            'is_online' => ['required', 'boolean'],
            'price_without_feedback' => ['required', 'integer'],
            'price_with_feedback' => ['required', 'integer'],
            'direct_fee' => ['required', 'integer'],
            'awardable' => ['required', 'boolean']
        ];
    }
}
