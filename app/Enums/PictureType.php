<?php

namespace App\Enums;

use App\Enum;

class PictureType extends Enum {
    const userProfile = 0;
    const goodsProfile = 1;
    const __default = self::userProfile;
}