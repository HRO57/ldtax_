<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UddesshoLokkhoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uddessho_lokkho_description'  => $this->uddessho_lokkho_description,
            'created_at' => $this->created_at,

        ];
    }
}
