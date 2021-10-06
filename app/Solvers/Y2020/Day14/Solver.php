<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day14;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\LazyCollection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $emulator = new Emulator();
        $this
            ->getInput()
            ->each(fn (Instruction $instruction) => $instruction->execute($emulator));

        return new PrimitiveValueSolution($emulator->sumMemory());
    }

    protected function solvePartTwo(): Solution
    {
        $emulator = new VersionTwoEmulator();

        $this
            ->getInput()
            ->each(fn (Instruction $instruction) => $instruction->execute($emulator));

        return new PrimitiveValueSolution($emulator->sumMemory());
    }

    private function getInput(): LazyCollection
    {
        return $this
            ->readLazy('2020', '14')
            ->map(fn (string $line) => Instruction::fromLine($line));
    }
}
