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
//            'contract_number.required' => ['Не указан номер договора'],
            'contract_number.integer' => ['Значение должно быть числовым'],
            'contract_number.unique' => ['Договор с таким номером уже создан'],
            'sum.required' => ['Не указана сумма договора'],
            'sum.integer' => ['Значение должно быть числовым'],
            'profit.integer' => ['Значение должно быть числовым'],
            'duration.integer' => ['Значение должно быть числовым'],
            'monthly_payment.integer' => ['Значение должно быть числовым'],
            'user_id.required' => ['Укажите клиента'],
            'briefcase_id.required' => ['Укажите программу'],
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
            'user_id' => ['required'],
            'briefcase_id' => ['required'],
            'contract_number' => [
                'nullable',
                'max:255',
                'unique:user_briefcase,contract_number,' . data_get($this, 'id')
            ],
            'sum' => ['required', 'integer'],
            'profit' => ['integer'],
            'duration' => ['integer'],
            'monthly_payment' => ['integer'],
        ];
    }
}
