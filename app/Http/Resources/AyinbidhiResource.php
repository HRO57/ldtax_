<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AyinbidhiResource extends JsonResource
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
            'title' => $this->title,
            'created_at' => $this->created_at,
            'ayinbidhi_pdf' => asset(Storage::url($this->ayinbidhi_pdf)),
            'created_at' => $this->created_at,

        ];
    }
}
