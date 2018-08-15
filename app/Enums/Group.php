<?php

namespace App\Enums;

use App\Enum;

class Group extends Enum {
    const admin = 0;
    const normal = 1;
    const __default = self::normal;
}