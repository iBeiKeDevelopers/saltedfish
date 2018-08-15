<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Picture extends JsonResource
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
            'id'            =>      $this->id,
            'src'           =>      $this->src,
            'alt'           =>      $this->alt,
            'created_at'    =>      $this->created_at,
            'updated_at'    =>      $this->updated_at,
        ];
    }
}
