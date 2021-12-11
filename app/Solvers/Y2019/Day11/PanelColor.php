<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day11;

use App\Contracts\DisplayableOnGrid;

enum PanelColor: int implements DisplayableOnGrid
{
    case BLACK = 0;
    case WHITE = 1;

    public function character(): string
    {
        if ($this === self::BLACK) {
            return ' ';
        }
        return DisplayableOnGrid::FULL_BLOCK;
    }
}
