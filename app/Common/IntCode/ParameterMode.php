<?php

declare(strict_types=1);

namespace App\Common\IntCode;

enum ParameterMode: int
{
    case POSITION = 0;
    case IMMEDIATE = 1;
    case RELATIVE = 2;
}
