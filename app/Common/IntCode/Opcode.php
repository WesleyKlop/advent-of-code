<?php

declare(strict_types=1);

namespace App\Common\IntCode;

enum Opcode: int
{
    case ADD = 1;
    case MUL = 2;
    case INPUT = 3;
    case OUTPUT = 4;

    case HALT = 99;
}
