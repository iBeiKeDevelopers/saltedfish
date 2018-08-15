<?php

namespace App\Enums;

use App\Enum;

class OrderType extends Enum {
    const from = 0;
    const to = 1;
    const __default = self::from;
}