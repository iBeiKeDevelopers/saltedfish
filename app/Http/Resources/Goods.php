<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Goods extends JsonResource
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
            'title'         =>      $this->title,
            'img'           =>      $this->img,
            'status'        =>      $this->status,
            'type'          =>      $this->type,
            'single_cost'   =>      $this->single_cost,
            'remail'        =>      $this->remain,
            'owner'         =>      $this->owner,
            'fee'           =>      $this->fee,
            'info'          =>      $this->info,
            'tags'          =>      $this->tags,
            'cl_lv_1'       =>      $this->cl_lv_1,
            'cl_lv_2'       =>      $this->cl_lv_2,
            'cl_lv_3'       =>      $this->cl_lv_3,
            'heat'          =>      $this->heat,
            'updated_at'    =>      $this->updated_at,
            'created_at'    =>      $this->created_at,
        ];
    }
}
