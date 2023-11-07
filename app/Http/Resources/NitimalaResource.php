<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NitimalaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nitimala_description'  => $this->nitimala_description,
            'created_at' => $this->created_at,

        ];
    }
}
