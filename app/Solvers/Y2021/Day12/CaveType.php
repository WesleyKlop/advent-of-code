<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day12;

enum CaveType
{
    case START;
    case END;
    case BIG;
    case SMALL;

    public static function type(string $cave): CaveType
    {
        if ($cave === 'start') {
            return self::START;
        }
        if ($cave === 'end') {
            return self::END;
        }
        if ($cave === strtoupper($cave)) {
            return self::BIG;
        }
        return self::SMALL;
    }
}
