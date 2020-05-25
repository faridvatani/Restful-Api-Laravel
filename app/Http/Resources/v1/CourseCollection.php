<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'data' => $this->collection->map(function ($item){
                return [
                    'CourseID' => $item->id,
                    'title' => $item->title,
                    'body' => $item->body,
                    'image' => $item->image,
                    'Createdat' => jdate($item->created_at)->format('Y-m-d H:i:s'),
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }
}
