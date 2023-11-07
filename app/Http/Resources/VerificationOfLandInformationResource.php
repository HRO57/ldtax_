<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VerificationOfLandInformationResource extends JsonResource
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
            'image_url' => asset(Storage::url($this->image)),
            'title' => $this->title,
            'link' => $this->link,
            'created_at' => $this->created_at,

        ];
    }
}
