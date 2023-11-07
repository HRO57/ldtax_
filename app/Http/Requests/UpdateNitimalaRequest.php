<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNitimalaRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
            'nitimala_description'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nitimala_description.required' => 'বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
