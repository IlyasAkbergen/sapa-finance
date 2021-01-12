<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BriefcaseUserRequest extends FormRequest
{
    protected $errorBag = 'orderForm';
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
            'contract_number.required' => ['Не указан номер договора'],
            'contract_number.integer' => ['Значение должно быть числовым'],
            'sum.required' => ['Не указана сумма договора'],
            'sum.integer' => ['Значение должно быть числовым'],
            'profit.integer' => ['Значение должно быть числовым'],
            'duration.integer' => ['Значение должно быть числовым'],
            'monthly_payment.integer' => ['Значение должно быть числовым'],
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
            'id' => ['required'],
            'contract_number' => ['required', 'max:255'],
            'sum' => ['required', 'integer'],
            'profit' => ['integer'],
            'duration' => ['integer'],
            'monthly_payment' => ['integer'],
        ];
    }
}
