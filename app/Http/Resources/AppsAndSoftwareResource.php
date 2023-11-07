<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AppsAndSoftwareResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'image_url'     => asset(Storage::url($this->image)),
            'link'          => $this->link,
            'type'          => $this->type,
            'title'         => $this->title,
            'created_at' => $this->created_at,

        ];
    }
}
