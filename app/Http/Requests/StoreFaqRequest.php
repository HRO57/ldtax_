<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => 'required|string',
            'answer' => 'required|string',
            'show_sl' => 'nullable|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => 'প্রশ্ন  ঘরটি অবশ্যই পূরণ করতে হবে',
            'answer.required' => 'উত্তর  ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
