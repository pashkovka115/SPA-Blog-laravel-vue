<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_post_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'img' => $this->img,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
