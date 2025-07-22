<?php

namespace App\Enums;

use mysql_xdevapi\Collection;

enum orderStatus: string
{
    case Pending = 'pending';
    case Preparing = 'preparing';
    case Completed = 'completed';

    public static function toArray()
    {
        return collect (static::cases())
            ->mapWithKeys(function ($case) {
                return [$case->name=>$case->value];
            })
            ->toArray();
    }
}
