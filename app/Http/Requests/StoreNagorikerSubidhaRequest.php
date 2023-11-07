<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorenagorikerSubidhaRequest extends FormRequest
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
                    'nagoriker_subidha_description'     => 'required|string',
                    'status'  => 'required|boolean',
                ];
            }

    public function messages()
            {
                return [
                    // 'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
                    'nagoriker_subidha_description.required' => 'বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
                ];
            }
}