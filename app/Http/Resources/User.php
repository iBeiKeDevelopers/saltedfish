<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
             * auto-increments
             * @param integer
             */
            'id'                =>          $this->id,

            /**
             * shown to others
             * @param string
             */
            'name'              =>          $this->nick_name,

            /**
             * for future use
             * @param string
             */
            'email'             =>          $this->email,

            /**
             * encrypted password
             * shall NOT return
             * @param string
             */
            //'password'          =>          $this->password,

            /**
            * the account number used in the bbs
            * @param string
            */
            'account_number'    =>          $this->account_number,

            /**
            * mostly for underpraduate students
            * - 8 digit number
            * - like 417XXXXX
            * - 'S' + 8 digit number
            * - or something else
            * //todo using number only
            * @param string
            */
            'student_id'        =>          $this->student_id,

            /**
             * the following params are optional
             * 
             * reserved param
             * @param string date('Y-m-d')
             */
            'birthday'          =>          $this->birthday,

            /**
             * real name
             * @param string
             */
            'name'              =>          $this->name,

            /**
             * options
             * - undergrade
             * - something else
             * @param string
             */
            'degree'            =>          $this->degree,

            /**
             * @param string
             */
            'class'             =>          $this->class,

            /**
             * @param integer between 1 - 22(maybe)
             */
            'domitory'          =>          $this->donitory,

            /**
             * 4 digit number
             * - like 401 and 1001
             * especially, the number's bit shall NOT be ZERO
             * @param integer
             */
            'room'              =>          $this->room,

            /**
             * 11 bits number
             * like 1234-1234-123
             * @param integer
             */
            'phone_number'      =>          $this->phone_name,

            /**
             * options
             * - normal
             * - admin
             * - something else?
             * @param string
             */
            'group'             =>          $this->group,
        ];
    }
}