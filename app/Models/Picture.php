<?php

namespace App\Models;

use App\Enums\PictureType;

use Illuminate\Database\Eloquent\Model;

class Picture extends Data
{
    protected $table = 'picture';

    public function get_name($pic) {
        if($this->check($extension)) {
            $extension = $pic->getClientOriginalEstension();
            return md5(time()).random_int(5,5) . '.' . $extension;
        }else
            return null;
    }

    public function get_path($pic, $type = 'userProfile') {
        $type = new PictureType($type);
        switch($type) {
            case PictureType::goodsProfile:
                return '/goods' . date("/Y/m/");
            case PictureType::userProfile:
                return 'avatar' . date("/Y/m/");
        }
    }
}
