<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RingtoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'liked' => $this->liked?:0,
            'categories' =>
                CategoryResource::collection($this->categories),
            'id' => $this->id,
            'name' => $this->name,
            'thumbnail_image' => asset('storage/ringtones/'.$this->thumbnail_image),
            'ringtone_file'=>asset('storage/ringtones/'.$this->ringtone_file),
            'like_count' => $this->like_count,
            'views' => $this->view_count,
            'downloads' => $this->downloads,
            'feature' => $this->feature,
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
