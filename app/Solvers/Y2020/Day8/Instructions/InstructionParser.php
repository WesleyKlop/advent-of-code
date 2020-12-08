<?php


namespace App\Solvers\Y2020\Day8\Instructions;

use App\Exceptions\ApplicationException;

class InstructionParser
{
    public static function fromString(string $instruction): Instruction
    {
        [$type, $mod] = explode(" ", $instruction);
        switch ($type) {
            case Instruction::NOOP:
                return new NopInstruction(intval($mod, 10));
            case Instruction::JUMP:
                return new JmpInstruction(intval($mod, 10));
            case Instruction::ACC:
                return new AccInstruction(intval($mod, 10));
        }
        throw new ApplicationException("Invalid instruction \"$type\"");
    }
}
