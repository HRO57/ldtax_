<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                            => $this->id,
            'title'                         => $this->title,
            'short_description'             => $this->short_description,
            'web_link'                      => $this->link,
            'app_link'                      => $this->app_link,
            'image_url'                     => asset(Storage::url($this->image)),
            'long_description'              => $this->long_description,
            'sheba_praptir_somoy'           => $this->sheba_praptir_somoy,
            'proyojoniyo_fee'               => $this->proyojoniyo_fee,
            'proyojoniyo_isthan'            => $this->proyojoniyo_isthan,
            'dayetto_praptto_kormokortta'   => $this->dayetto_praptto_kormokortta,
            'proyojoniyo_kagojpotro'        => $this->proyojoniyo_kagojpotro,
            'songlistho_aino_bodhi'        => $this->songlistho_aino_bodhi,
            'sheba_prodane_bertho'          => $this->sheba_prodane_bertho,
            'sheba_prodane_proyojoniyo_link'=> $this->sheba_prodane_proyojoniyo_link,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
