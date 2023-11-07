<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAyinbidhiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
            {
                return [
                    'title' => ['required', 'string', 'max:255'],
                    'ayinbidhi_pdf' => ['required', 'mimes:pdf'],
                ];
            }

    public function messages()
            {
                return [
                    'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
                    'ayinbidhi_pdf.required' => 'বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
                ];
            }
}