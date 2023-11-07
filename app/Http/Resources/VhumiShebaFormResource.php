<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VhumiShebaFormResource extends JsonResource
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
            'vhumi_sheba_form_pdf' => asset(Storage::url($this->vhumi_sheba_form_pdf)),
        ];
    }
}
