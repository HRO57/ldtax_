<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAyinbidhiRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

    

    public function rules(): array
    {
        return [
            'title'         => ['string', 'max:255'],
            'ayinbidhi_pdf' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'ayinbidhi_pdf.required' => 'বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
