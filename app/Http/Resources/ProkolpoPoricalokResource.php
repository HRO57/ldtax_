<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProkolpoPoricalokResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            
            'title'                         => $this->title,
            'image_url'                     => asset(Storage::url($this->image)),
            'short_description'             => $this->short_description,
            'long_description'              => $this->long_description,
        ];
    }
}
