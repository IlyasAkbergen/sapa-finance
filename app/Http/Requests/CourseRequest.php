<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required|max:255'],
            'short_description' => ['required|max:255'],
            'description' => ['required'],
            'is_online' => ['required', 'boolean'],
            'price_without_feedback' => ['required', 'integer'],
            'price_with_feedback' => ['required', 'integer'],
            'direct_fee' => ['required', 'integer'],
            'awardable' => ['required', 'boolean']
        ];
    }
}
