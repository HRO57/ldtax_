<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProkolpoSarsongkhepResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'prokolpo_sarsongkhep_description'  => $this->prokolpo_sarsongkhep_description,
            'created_at' => $this->created_at,

        ];
    }
}
