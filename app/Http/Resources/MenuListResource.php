<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuListResource extends JsonResource
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
            'is_main' => $this->is_main,
            'link' => $this->link,
            'title' => $this->title,
            'created_at' => $this->created_at,

        ];
    }
}
