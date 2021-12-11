<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day11;

enum Direction: int
{
    case UP = 0;
    case DOWN = 180;
    case LEFT = 270;
    case RIGHT = 90;
}
