<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuListRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

 
    public function rules(): array
    {
        return [
            'is_main' => 'required|boolean',
            // 'link' => 'required_if:is_main,false|string',
            'title' => 'required|string',
            'show_sl' => 'nullable|numeric|min:1',
        ];
    }
}
