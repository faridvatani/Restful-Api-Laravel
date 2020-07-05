<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\v1\EpisodeCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Course extends JsonResource
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
            'CourseID' => $this->id,
            'title' => $this->title,
            'body' => Str::limit($this->body, 200),
            'image' => $this->image,
            'data' => jdate($this->created_at)->format('Y-m-d H:i:s'),
            'episodes' => new EpisodeCollection($this->episodes)
        ];
    }
}
