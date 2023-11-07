<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProkolperOutputRequest extends FormRequest
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
            'prokolper_output_description'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'prokolper_output_description.required' => 'বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
