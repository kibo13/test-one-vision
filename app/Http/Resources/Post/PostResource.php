<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->user->name,
            'dummy_post_id' => $this->dummy_post_id,
            'title' => $this->title,
            'body' => truncate_text($this->body),
        ];
    }
}
