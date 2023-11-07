<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandServiceAndSoftwareRequest extends FormRequest
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
            // 'image'     => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'show_sl'   => 'nullable|numeric|min:1',
            'link'      => 'required|url',
            'type'      => 'required',
            'title'     => 'required', 'string', 'max:255',
        ];
    }
}
