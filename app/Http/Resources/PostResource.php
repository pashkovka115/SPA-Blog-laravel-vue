<?php

namespace App\Http\Resources;

use App\Models\Like;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user),
            'liked' => $this->isLiked($this->id, $this->user->id),
            'likes' => $this->likes->count(),
            'tags' => TagResource::collection($this->tags),
        ];
    }


    public function isLiked($post_id, $user_id)
    {
        if (Like::whereUserId($user_id)->wherePostId($post_id)->exists()) {
            return true;
        }else
            return false;
    }
}
