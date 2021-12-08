<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Program;

class AddInstruction extends Instruction
{
    public function readParameters(Program $program): array
    {
        dump('Reading parameters for AddInstruction');
        $parameters = [1, 2];
        foreach ($parameters as $idx => $offset) {
            $mode = $this->getParameterMode($idx);
            $parameters[$idx] = $program->readPosition($this->instructionPointer + $offset);
            $parameters[$idx] = $program->read($parameters[$idx], $mode);
        }
        dump('Finished reading parameters');
        return $parameters;
    }

    public function readDestinationAddress(Program $program): int
    {
        return $program->read($this->instructionPointer + 3);
    }
}
