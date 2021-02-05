<?php


namespace App\Solvers\Y2020\Day14;

class MemoryInstruction extends Instruction
{
    private int $address;
    private int $value;

    public function __construct(int $address, int $value)
    {
        $this->address = $address;
        $this->value = $value;
    }


    public function execute(Emulator $emulator): void
    {
        $emulator->writeToMemory($this->address, $this->value);
    }
}
