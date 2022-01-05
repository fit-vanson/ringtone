<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureWallpaperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        foreach ($this->ringtones->take(1) as $item){
            return [
                'categories' =>
                    CategoryResource::collection($item->categories),
                'id' => $item->id,
                'name' => $item->name,
                'thumbnail_image' => asset('storage/ringtones/' . $item->thumbnail_image),
                'ringtone_file' => asset('storage/ringtones/' . $item->ringtone_file),
                'like_count' => $item->like_count,
                'views' => $item->view_count,
                'feature' => $item->feature,
                'created_at' => $item->created_at->format('d/m/Y'),
            ];
        }
    }
}
