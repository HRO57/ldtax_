<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NoticeResource extends JsonResource
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

            'is_top'     => $this->is_top,
            'notice'     => $this->notice,
            'notice_pdf' => asset(Storage::url($this->notice_pdf)),
            'id'         => $this->id,
            'created_at'         => $this->created_at,
        ];
    }
}