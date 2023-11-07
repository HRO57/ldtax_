<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeRequest extends FormRequest
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
            'show_sl'       => 'nullable|integer',
            'is_top'        => 'required|boolean',
            'notice'        => 'required|string|max:500',
            'notice_pdf'    => 'required',
            'status'        => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'notice.required' => 'নোটিশ ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
