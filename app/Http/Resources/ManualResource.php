<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ManualResource extends JsonResource
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
        'manual_pdf' => asset(Storage::url($this->manual_pdf)),
        'manual_doc' => asset(Storage::url($this->manual_doc)),
        'created_at' => $this->created_at,

    ];
}

}
