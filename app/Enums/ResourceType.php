<?php

namespace App\Enums;

use App\Enum;

class ResourceType extends Enum {
    const Goods = "Goods";
    const Order = "Order";
    const User = "User";
    const __default = self::Goods;
}