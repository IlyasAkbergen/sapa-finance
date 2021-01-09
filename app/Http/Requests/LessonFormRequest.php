<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LessonFormRequest extends FormRequest
{
    protected $errorBag = 'lessonForm';
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
            'video_url.required' => ['Укажите ссылку на видео'],
//            'content.required' => ['Укажите описание урока'],
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
//            'content' => ['required'],
            'video_url'=> ['required', 'max:255'],
            'uuid' => ['required_without:id']
        ];
    }
}
