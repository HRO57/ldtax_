<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    
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
            'title'                             => 'required|string',
            'short_description'                 => 'required|string',
            'link'                              => 'required|url',
            'app_link'                          => 'required|url',
            // 'image'                             => 'required|mimes:jpeg,png,jpg|max:2048',
            'long_description'                  => 'required|string',
            'sheba_praptir_somoy'               => 'required|string',
            'proyojoniyo_fee'                   => 'required|string',
            'proyojoniyo_isthan'                => 'required|string',
            'proyojoniyo_kagojpotro'            => 'required|string',
            'songlistho_aino_bodhi'             => 'required|string',
            'sheba_prodane_bertho'              => 'required|string',
            'sheba_prodane_proyojoniyo_link'    => 'required|string',
        ];
    }
}
