<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProkolpoPoricalokRequest extends FormRequest
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
            'title'                             => 'required',
            'short_description'                 => 'required|string',
            'image'                             => 'required|mimes:jpeg,png,jpg|max:2048',
            'long_description'                  => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
            'short_description.required' => 'ছোট বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
            'image.required' => 'ছবি ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'long_description.required' => 'ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
