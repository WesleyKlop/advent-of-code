<?php

declare(strict_types=1);

namespace App\Common\IntCode;

use App\Common\IntCode\Instructions\Instruction;
use App\Common\IntCode\IO\HasIoDevice;

class Computer
{
    use HasIoDevice;

    private int $instructionPointer = 0;

    public function __construct(
        private Program $program,
    ) {
    }

    public function reset(): void
    {
        $this->instructionPointer = 0;
        $this->program->reset();
    }

    public function run(): void
    {
        do {
            $instruction = $this->readInstruction();
            $jump = $this->execute($instruction);
            $this->instructionPointer += $jump;
        } while ($instruction->opcode !== Opcode::HALT);
    }

    public function execute(Instruction $instruction): int
    {
        switch ($instruction->opcode) {
            case Opcode::ADD:
                [$a, $b] = $instruction->readParameters($this->program);
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $a + $b);
                return 3;
            case Opcode::MUL:
                [$a, $b] = $instruction->readParameters($this->program);
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $a * $b);
                return 3;
            case Opcode::INPUT:
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $this->inputProvider->read());
                return 2;
            case Opcode::OUTPUT:
                [$output] = $instruction->readParameters($this->program);
                $this->outputProvider->write($output);
                return 2;
            case Opcode::HALT:
                // We are finished!
                return 0;
        }
        throw new IntCodeException('Unreachable code reached');
    }

    private function readInstruction(): Instruction
    {
        $raw = $this->program->read($this->instructionPointer);
        return Instruction::fromRaw($raw, $this->instructionPointer);
    }
}
