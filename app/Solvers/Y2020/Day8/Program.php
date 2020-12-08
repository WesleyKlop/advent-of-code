<?php


namespace App\Solvers\Y2020\Day8;

use App\Solvers\Y2020\Day8\Instructions\AbstractInstruction;
use App\Solvers\Y2020\Day8\Instructions\ExitInstruction;
use App\Solvers\Y2020\Day8\Instructions\Instruction;
use App\Solvers\Y2020\Day8\Instructions\InstructionParser;
use App\Solvers\Y2020\Day8\Instructions\JmpInstruction;
use App\Solvers\Y2020\Day8\Instructions\NopInstruction;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

class Program
{
    private Collection $instructions;

    public function __construct(Collection $instructions)
    {
        $this->instructions = $instructions;
    }

    public function print(): void
    {
        $this->instructions->each(fn (AbstractInstruction $instruction) => $instruction->print());
    }

    public static function fromStringable(Stringable $txtProgram): Program
    {
        $instructions = $txtProgram
            ->explode("\n")
            ->map(fn (string $instruction) => InstructionParser::fromString($instruction));
        return new static($instructions);
    }

    public function getInstruction(int $ptr): Instruction
    {
        if ($this->instructions->has($ptr)) {
            return $this->instructions->get($ptr);
        }

        return new ExitInstruction();
    }

    public function replaceInstruction(int $ptr, Instruction $instruction)
    {
        $this->instructions->put($ptr, $instruction);
    }

    public function flipInstruction(int $ptr)
    {
        $instruction = $this->getInstruction($ptr);
        if ($instruction instanceof JmpInstruction) {
            $this->replaceInstruction($ptr, $instruction->transform(NopInstruction::class));
        } elseif ($instruction instanceof NopInstruction) {
            $this->replaceInstruction($ptr, $instruction->transform(JmpInstruction::class));
        }
    }

    public function lastIndex(): int
    {
        return $this->instructions->count() - 1;
    }
}
