<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'body' => $this->body,
            'image' => $this->image,
            'Createdat' => jdate($this->created_at)->format('Y-m-d H:i:s'),
            'episodes' => new EpisodeCollection($this->episodes)
        ];
    }
}
