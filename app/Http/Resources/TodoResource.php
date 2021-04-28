<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
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
            'user' => $this->user->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'published_on' => $this->created_at->diffForHumans()
        ];
    }
}
