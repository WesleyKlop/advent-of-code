<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Program;

class HaltInstruction extends Instruction
{
    public function readParameters(Program $program): array
    {
        return [];
    }

    public function readDestinationAddress(Program $program): int
    {
        return 0;
    }
}
