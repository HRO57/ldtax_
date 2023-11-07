<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFestiableImageRequest extends FormRequest
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
                    'image' => 'required|mimes:jpeg,png,jpg|max:2097152',
                    'title' => ['required', 'string', 'max:255'],
                ];
            }
    public function messages()
            {
                return [
                    'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
                    'image.max'      => 'চিত্রটির সর্বাধিক আকার 2MB হতে হবে',
                ];
            }
}
