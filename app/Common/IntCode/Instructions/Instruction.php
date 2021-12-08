<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Opcode;
use App\Common\IntCode\ParameterMode;
use App\Common\IntCode\Program;
use Illuminate\Support\Str;

abstract class Instruction
{
    /**
     * @param list<ParameterMode> $parameterModes
     */
    public function __construct(
        public readonly Opcode $opcode,
        public readonly array $parameterModes,
        public readonly int $raw,
        protected readonly int $instructionPointer,
    ) {
    }

    public static function fromRaw(int $raw, int $instructionPointer): self
    {
        $opcode = Opcode::from($raw % 100);
        $parameterModes = Str::of($raw)
            ->substr(0, -2)
            ->split(1)
            ->transform(fn (string $char) => ParameterMode::from((int) $char))
            ->all();

        return match ($opcode) {
            Opcode::ADD => new AddInstruction($opcode, $parameterModes, $raw, $instructionPointer),
            Opcode::MUL => new MulInstruction($opcode, $parameterModes, $raw, $instructionPointer),
            Opcode::INPUT => new InputInstruction($opcode, $parameterModes, $raw, $instructionPointer),
            Opcode::OUTPUT => new OutputInstruction($opcode, $parameterModes, $raw, $instructionPointer),
            Opcode::HALT => new HaltInstruction($opcode, $parameterModes, $raw, $instructionPointer),
        };
    }

    public function getParameterMode(int $idx): ParameterMode
    {
        return $this->parameterModess[$idx] ?? ParameterMode::POSITION;
    }

    /**
     * @param Program $program *@return list<int>
     */
    abstract public function readParameters(Program $program): array;

    abstract public function readDestinationAddress(Program $program): int;
}
