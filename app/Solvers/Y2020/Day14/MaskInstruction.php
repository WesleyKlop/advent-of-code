<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day14;

class MaskInstruction extends Instruction
{
    public function __construct(
        private string $mask
    ) {
    }

    public function execute(Emulator $emulator): void
    {
        $emulator->updateBitmask($this->mask);
    }
}
