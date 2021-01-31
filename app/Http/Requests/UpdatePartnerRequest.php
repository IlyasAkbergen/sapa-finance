<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePartnerRequest extends FormRequest
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
            'phone.unique' => ['Номер занят другим пользователем'],
            'email.required' => ['Укажите email'],
            'email.unique' => ['email занят другим пользователем'],
            'bin.required' => ['Укажите БИН']
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
            'email' => ['required', 'max:255', 'unique:users,email,'.$this->id],
            'phone' => ['required', 'unique:users,phone,'.$this->id],
            'image' => ['required_without:id'],
            'bin' => ['required'],
            'email_verified_at' => ['nullable'],
        ];
    }
}
