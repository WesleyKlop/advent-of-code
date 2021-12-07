<?php

declare(strict_types=1);

namespace App\Common\IntCode;

class Computer
{
    private int $instructionPointer = 0;

    public function __construct(
        private Program $program,
    ) {
    }

    public function reset(Program $program): void
    {
        $this->instructionPointer = 0;
        $this->program = $program;
    }

    public function run(): void
    {
        do {
            $opcode = $this->readOpcode();
            [$aAddress, $bAddress, $destinationAddress] = $this->readArguments();

            switch ($opcode) {
                case Opcode::ADD:
                    $a = $this->program->read($aAddress);
                    $b = $this->program->read($bAddress);
                    $this->program->write($destinationAddress, $a + $b);
                    break;
                case Opcode::MUL:
                    $a = $this->program->read($aAddress);
                    $b = $this->program->read($bAddress);
                    $this->program->write($destinationAddress, $a * $b);
                    break;
                case Opcode::HALT:
                    // We are finished!
                    break;
            }
            $this->instructionPointer += 4;
        } while ($opcode !== Opcode::HALT);
    }

    private function readOpcode(): Opcode
    {
        $raw = $this->program->read($this->instructionPointer);
        return (new Opcode())->from($raw);
    }

    private function readArguments(): array
    {
        return iterator_to_array(
            $this->program->readMany($this->instructionPointer + 1, 3)
        );
    }
}
