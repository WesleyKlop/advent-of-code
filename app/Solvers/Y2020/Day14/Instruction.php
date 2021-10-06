<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day14;

abstract class Instruction
{
    public static function fromLine(string $line): static
    {
        [$instruction, $value] = explode(' = ', $line);
        if ($instruction === 'mask') {
            return new MaskInstruction($value);
        }

        preg_match("/^mem\[(\d+)\]$/", $instruction, $matches);

        return new MemoryInstruction($matches[1], $value);
    }

    abstract public function execute(Emulator $emulator): void;
}
