<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuListRequest extends FormRequest
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
                    'is_main' => 'required|boolean',
                    // 'link'    => 'required|url',
                    'title' => 'required|string',
                    'show_sl' => 'nullable|numeric|min:1',
                ];
            }

    public function messages()
            {
                return [
                    'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
                    'link.required' => 'লিঙ্ক ঘরটি অবশ্যই পূরণ করতে হবে',
                ];
            }
}
