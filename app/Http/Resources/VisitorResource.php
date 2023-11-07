<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitorResource extends JsonResource
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
            'ip'               => $this->ip,
            'visitor_name'     => $this->visitor_name,
            'visitor_intime'   => $this->visitor_intime,
            'visitor_timeout'  => $this->visitor_timeout,

        ];
    }
}
