<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Program;

class InputInstruction extends Instruction
{
    public function readParameters(Program $program): array
    {
        $parameters = [1, 2];
        foreach ($parameters as $idx => $offset) {
            $mode = $this->getParameterMode($idx);
            $parameters[$idx] = $program->read($this->instructionPointer + $offset, $mode);
        }
        return $parameters;
    }

    public function readDestinationAddress(Program $program): int
    {
        return $program->read($this->instructionPointer + 3);
    }
}
