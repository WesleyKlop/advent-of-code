<?php

declare(strict_types=1);

namespace App\Common\IntCode\Instructions;

use App\Common\IntCode\Opcode;
use App\Common\IntCode\ParameterMode;
use App\Common\IntCode\Program;
use Illuminate\Support\Str;

class Instruction
{
    /**
     * @param list<ParameterMode> $parameterModes
     */
    public function __construct(
        public readonly Opcode $opcode,
        public readonly array $parameterModes,
        protected readonly int $instructionPointer,
        private readonly int $parameterCount,
    ) {
    }

    public static function fromRaw(int $raw, int $ip): self
    {
        $opcode = Opcode::from($raw % 100);
        $parameterModes = Str::of($raw)
            ->substr(0, -2)
            ->split(1)
            ->reverse()
            ->map(fn (string $char) => ParameterMode::from((int) $char))
            ->values()
            ->toArray();
        $parameterCount = match ($opcode) {
            Opcode::OUTPUT => 1,
            Opcode::INPUT, Opcode::HALT => 0,
            default => 2,
        };

        return new static($opcode, $parameterModes, $ip, $parameterCount);
    }

    public function getParameterMode(int $idx): ParameterMode
    {
        // By default, parameters are in position mode
        return $this->parameterModes[$idx] ?? ParameterMode::POSITION;
    }

    public function readParameters(Program $program): array
    {
        $parameters = range(1, $this->parameterCount);
        foreach ($parameters as $idx => $offset) {
            $mode = $this->getParameterMode($idx);
            $parameters[$idx] = $program->read($this->instructionPointer + $offset);
            if ($mode === ParameterMode::POSITION) {
                $parameters[$idx] = $program->read($parameters[$idx]);
            }
        }
        return $parameters;
    }

    public function readDestinationAddress(Program $program): int
    {
        return $program->read($this->instructionPointer + $this->parameterCount + 1);
    }
}
