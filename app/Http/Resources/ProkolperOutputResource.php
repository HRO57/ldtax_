<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProkolperOutputResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'prokolper_output_description'  => $this->prokolper_output_description,
            'created_at' => $this->created_at,

        ];
    }
}
