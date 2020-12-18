<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BriefcaseRequest extends FormRequest
{
    protected $errorBag = 'briefcaseForm';
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
            'type_id.required' => 'Укажите тип',
            'description.required' => ['Укажите полное описание'],
            'sum.required' => ['Не указан способ проведения'],
            'sum.integer' => ['Значение должно быть числовым'],
            'profit.required' => ['Не указан способ проведения'],
            'profit.integer' => ['Значение должно быть числовым'],
            'duration.required' => ['Укажите цену без обратной связи'],
            'duration.integer' => ['Значение должно быть числовым'],
            'monthly_payment.integer' => ['Значение должно быть числовым'],
            'direct_fee.required' => ['Укажите комиссию агента'],
            'direct_fee.integer' => ['Значение должно быть числовым'],
            'image.required_without' => ['Не загружено изображение курса']
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
            'type_id' => ['required', 'integer'],
            'description' => ['required'],
            'sum' => ['required', 'integer'],
            'profit' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            'monthly_payment' => ['integer'],
            'direct_fee' => ['required', 'integer'],
            'image' => ['required_without:id', 'file'],
            'awardable' => ['required']
        ];
    }
}
