<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePoripotroProggaponRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            // 'poripotro_proggapon_pdf' => "required|mimes:pdf|max:10000",
            // 'poripotro_proggapon_doc' => 'required|file|max:5000|mimes:pdf',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
