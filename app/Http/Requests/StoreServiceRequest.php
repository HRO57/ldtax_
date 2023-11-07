<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title'                             => 'required',
            'short_description'                 => 'required|string',
            'link'                              => 'required|url',
            'app_link'                          => 'required|url',
            'image'                             => 'required|mimes:jpeg,png,jpg|max:2048',
            'long_description'                  => 'required|string',
            'sheba_praptir_somoy'               => 'required|string',
            'proyojoniyo_fee'                   => 'required|string',
            'proyojoniyo_isthan'                => 'required|string',
            'proyojoniyo_kagojpotro'            => 'required|string',
            'songlistho_aino_bodhi'            => 'required|string',
            'sheba_prodane_bertho'              => 'required|string',
            'sheba_prodane_proyojoniyo_link'    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'শিরোনাম ঘরটি অবশ্যই পূরণ করতে হবে',
            'short_description.required' => 'ছোট বিবরণ ঘরটি অবশ্যই পূরণ করতে হবে',
            'link.required' => 'লিঙ্ক ঘরটি অবশ্যই পূরণ করতে হবে',
            'image.required' => 'ছবি ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'long_description.required' => 'ঘরটি অবশ্যই পূরণ করতে হবে',
            'sheba_praptir_somoy.required' => 'সেবা প্রাপ্তির সময় ঘরটি অবশ্যই পূরণ করতে হবে',
            'proyojoniyo_fee.required' => 'প্রয়োজনীয় ফি ঘরটি অবশ্যই পূরণ করতে হবে',
            'proyojoniyo_isthan.required' => 'সেবা প্রাপ্তির স্থান ঘরটি অবশ্যই পূরণ করতে হবে',
            'dayetto_praptto_kormokortta.required' => 'দায়িত্বপ্রাপ্ত কর্মকর্তা ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'proyojoniyo_kagojpotro.required' => 'ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'songlistho_aino_bodhi.required' => 'ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'sheba_prodane_bertho.required' => 'ঘরটি অবশ্যই পূরণ করতে হবে',
            // 'sheba_prodane_proyojoniyo_link.required' => 'ঘরটি অবশ্যই পূরণ করতে হবে',
        ];
    }
}
