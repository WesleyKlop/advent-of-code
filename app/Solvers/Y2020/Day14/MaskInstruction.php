<?php


namespace App\Solvers\Y2020\Day14;

class MaskInstruction extends Instruction
{
    private string $mask;

    public function __construct(string $mask)
    {
        $this->mask = $mask;
    }

    public function execute(Emulator $emulator): void
    {
        $emulator->updateBitmask($this->mask);
    }
}
