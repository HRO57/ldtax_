<?php

namespace App\Http\Resources;

use App\Models\RecentUpdate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RecentUpdateResource extends JsonResource
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
            'title'         => $this->title,
            'id'         => $this->id,
            'created_at'    => $this->created_at,
            'image_url'     => asset(Storage::url($this->image)),
            'details'       => $this->details,
            // 'related_more'  => RecentUpdate::latest()->limit(10)->get(),
        ];
    }
}
