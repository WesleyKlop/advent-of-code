<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day14;

class MemoryInstruction extends Instruction
{
    public function __construct(
        private int $address,
        private int $value
    ) {
    }

    public function execute(Emulator $emulator): void
    {
        $emulator->writeToMemory($this->address, $this->value);
    }
}
