<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Program;

class InputInstruction extends Instruction
{
    protected final const PARAMETER_COUNT = 1;
}
