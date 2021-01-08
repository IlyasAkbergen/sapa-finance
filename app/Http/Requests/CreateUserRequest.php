<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
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
            'name.required' => 'Укажите ФИО',
            'phone.required' => ['Укажите номер телефона'],
            'email.required' => ['Укажите email'],
            'email.unique' => ['email занят другим пользователем'],
            'iin.required' => ['Укажите ИИН'],
            'iin.unique' => ['ИИН занят другим пользователем'],
            'image.required_without' => ['Не загружено изображение профиля'],
            'role_id.required' => ['Укажите роль'],
            'direct_points.integer' => ['Значение должно быть числом'],
            'team_points.integer' => ['Значение должно быть числом']
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'image' => ['required_without:id'],
            'role_id' => ['required'],
            'iin' => ['required', 'numeric', 'unique:users'],
            'direct_points' => ['integer'],
            'team_points' => ['integer'],
        ];
    }
}
