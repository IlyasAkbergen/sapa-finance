<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BriefcasePaymentRequest extends FormRequest
{
    protected $errorBag = 'paymentForm';
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
            'sum.required' => ['Не указана сумма договора'],
            'sum.integer' => ['Значение должно быть числовым'],
            'user_id.required' => ['Укажите пользователя'],
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
            'sum' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'order_id' => ['required']
//            'payable_id' => ['required'],
//            'payable_type' => ['required'],
        ];
    }
}
