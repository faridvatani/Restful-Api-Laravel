<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EpisodeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item){
                return [
                    'episodeNumber' => $item->number,
                    'title' => $item->title,
                    'body' => $item->body,
                    'image' => $item->image,
                    'videoURL' => $item->videoUrl,
                    'Createdat' => jdate($item->created_at)->format('Y-m-d H:i:s'),
                ];
        });
    }
}
