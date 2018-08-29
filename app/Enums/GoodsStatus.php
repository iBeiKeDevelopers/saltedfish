<?php

namespace App\Enums;

use App\Enum;

class GoodsStatus extends Enum {
    const normal = 0;
    const soldout = 1;
    const offshelves = 2;

    const __default = self::normal;
}