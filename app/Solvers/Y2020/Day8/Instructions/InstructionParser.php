<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day8\Instructions;

use App\Exceptions\ApplicationException;

class InstructionParser
{
    public static function fromString(string $instruction): Instruction
    {
        [$type, $mod] = explode(' ', $instruction);
        return match ($type) {
            Instruction::NOOP => new NopInstruction(intval($mod, 10)),
            Instruction::JUMP => new JmpInstruction(intval($mod, 10)),
            Instruction::ACC => new AccInstruction(intval($mod, 10)),
            default => throw new ApplicationException("Invalid instruction \"${type}\""),
        };
    }
}
