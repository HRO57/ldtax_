<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManualRequest extends FormRequest
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
            // 'manual_pdf' => ['required'],
            // 'manual_doc' => [ 'required'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'manual_pdf.required' => 'পিডিএফ ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'manual_doc.required' => 'মাইক্রোসফট ওয়ার্ড ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
