<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Program;

class OutputInstruction extends Instruction
{
    public function readParameters(Program $program): array
    {
        dump('Reading parameters for OutputInstruction');
        $parameters = [1];
        foreach ($parameters as $idx => $offset) {
            $parameters[$idx] = $program->readPosition($this->instructionPointer + $offset);
        }
        dump('Finished reading parameters');
        return $parameters;
    }

    public function readDestinationAddress(Program $program): int
    {
        return $program->read($this->instructionPointer + 3);
    }
}
