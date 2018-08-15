<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
            /**
             * auto increment id
             * @param integer
             */
            'id'            =>      $this->id,

            /**
             * id of the comment above
             * default 0
             * @param integer
             */
            'before'        =>      $this->defore,

            /**
             * id of the comment below
             * default 0
             * @param integer
             */
            //'after'         =>      $this->after,

            /**
             * id of the user
             * @param integer
             */
            'user'          =>      $this->user,
            /**
             * nick name of the user
             * when the comment is submitted
             * @param string
             */
            'user_name'     =>      $this->user_name,

            /**
             * whole path of the avatar
             * @param string
             */
            'avatar_path'      =>      $this->avatar_path,

            /**
             * content
             * @param string
             */
            'content'          =>      $this->content,

            /**
             * time of submit
             * @param string
             */
            'created_at'    =>      $this->created_at,

            /**
             * time of the latest updat
             * for future use or not
             * @param string
             */
            //'updated_at'    =>      $this->updated_at,
        ];
    }
}
