<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends FormRequest
{
    protected $errorBag = 'articleForm';
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
            'content.required' => ['Укажите полное описание'],
            'image.required_without' => ['Не загружено изображение новости'],
            'created_at.required' => ['Укажите дату'],
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
            'image' => ['required_without:id', 'file'],
            'created_at' => ['required', 'date']
        ];
    }
}
