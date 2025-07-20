<?php

namespace App\Enums;

enum orderStatus: string
{
    case Pending = 'pending';
    case Preparing = 'preparing';
    case Completed = 'completed';
}
