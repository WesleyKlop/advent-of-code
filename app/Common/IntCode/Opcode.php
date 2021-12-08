<?php

declare(strict_types=1);

namespace App\Common\IntCode;

enum Opcode: int
{
    case ADD = 1;
    case MUL = 2;
    case INPUT = 3;
    case OUTPUT = 4;

    case JUMP_IF_TRUE = 5;
    case JUMP_IF_FALSE = 6;
    case LESS_THAN = 7;
    case EQUALS = 8;

    case HALT = 99;
}
