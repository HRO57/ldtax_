<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NagorikerSubidhaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nagoriker_subidha_description'  => $this->nagoriker_subidha_description,
            'created_at' => $this->created_at,

        ];
    }
}
