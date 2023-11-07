<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUddesshoLokkhoRequest extends FormRequest
{
   
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
            'uddessho_lokkho_description'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'uddessho_lokkho_description.required' => 'বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
