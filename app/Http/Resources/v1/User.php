<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function __construct($resource , $token)
    {
        $this->token = $token;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'remember_token' => $this->remember_token,
//            'api_token' => $this->api_token,
            'api_token' => $this->token,
            'Createdat' => jdate($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }
}
