<?php

declare(strict_types=1);

namespace App\Common\IntCode;

use App\Common\IntCode\Instructions\Instruction;
use App\Common\IntCode\IO\HasIoDevice;
use App\Common\IntCode\IO\InputProvider;

class Computer
{
    private static int $idCounter = 0;
    use HasIoDevice;

    private int $instructionPointer = 0;
    private int $id;


    public function __construct(private Program $program,)
    {
        $this->id = ++self::$idCounter;
    }

    public function reset(): void
    {
        $this->instructionPointer = 0;
        $this->program->reset();
    }

    public function pipeOutputInto(self $other): void
    {
        if (! $this->outputProvider instanceof InputProvider) {
            throw new IntCodeException("Could not attach two computers {$other->id} to {$this->id} :(");
        }

        $other->setInputProvider($this->outputProvider);
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
                return 4;
            case Opcode::MUL:
                [$a, $b] = $instruction->readParameters($this->program);
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $a * $b);
                return 4;
            case Opcode::INPUT:
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $this->inputProvider->read());
                return 2;
            case Opcode::OUTPUT:
                [$output] = $instruction->readParameters($this->program);
                $this->outputProvider->write($output);
                return 2;
            case Opcode::JUMP_IF_TRUE:
                [$a, $b] = $instruction->readParameters($this->program);
                if ($a !== 0) {
                    return $b - $this->instructionPointer;
                }
                return 3;
            case Opcode::JUMP_IF_FALSE:
                [$a, $b] = $instruction->readParameters($this->program);
                if ($a === 0) {
                    return $b - $this->instructionPointer;
                }
                return 3;
            case Opcode::LESS_THAN:
                [$a, $b] = $instruction->readParameters($this->program);
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $a < $b ? 1 : 0);
                return 4;
            case Opcode::EQUALS:
                [$a, $b] = $instruction->readParameters($this->program);
                $destinationAddress = $instruction->readDestinationAddress($this->program);
                $this->program->write($destinationAddress, $a === $b ? 1 : 0);
                return 4;
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
