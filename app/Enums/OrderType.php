<?php

namespace App\Enums;

use App\Enum;

class OrderType extends Enum {
    const sell = 0;
    const rent = 1;
    const __default = self::sell;
}