<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreporipotroProggaponRequest extends FormRequest
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
            'poripotro_proggapon_pdf' => ['required', 'file', 'mimes:pdf'],
            'poripotro_proggapon_doc' => ['required', 'mimes:doc,pdf'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
            'poripotro_proggapon_pdf.required' => 'পিডিএফ ঘরটি অবশ্যই পূরণ করতে হবে',
            'poripotro_proggapon_doc.required' => 'মাইক্রোসফট ওয়ার্ড ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
