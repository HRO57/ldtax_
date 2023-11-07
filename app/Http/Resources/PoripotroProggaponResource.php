<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PoripotroProggaponResource extends JsonResource
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
            'poripotro_proggapon_pdf' => asset(Storage::url($this->poripotro_proggapon_pdf)),
            'poripotro_proggapon_doc' => asset(Storage::url($this->poripotro_proggapon_doc)),
        ];
    }
}
