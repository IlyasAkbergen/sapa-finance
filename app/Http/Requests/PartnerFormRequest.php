<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PartnerFormRequest extends FormRequest
{
    protected $errorBag = 'partnerForm';
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
            'name.required' => 'Укажите наименование',
            'phone.required' => ['Укажите номер телефона'],
            'phone.unique' => ['Номер занят другим партнером'],
            'email.required' => ['Укажите email'],
            'email.unique' => ['email занят другим партнером'],
            'bin.required' => ['Укажите БИН'],
            'bin.unique' => ['ИИН занят другим партнером'],
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
            'email' => ['required', 'max:255', 'unique:users,email,'.$this->id ?:null],
            'phone' => ['required', 'unique:users,phone,'.$this->id ?:null],
            'bin' => ['required', 'numeric', 'unique:users,bin,'.$this->id ?:null],
            'email_verified_at' => ['nullable'],
        ];
    }
}
