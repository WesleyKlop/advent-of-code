<?php


namespace App\Solvers\Y2020\Day14;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;

class Solver extends \App\Solvers\AbstractSolver
{
    private function getInput(): \Illuminate\Support\LazyCollection
    {
        return $this
            ->readLazy('2020', '14', 'input.txt')
            ->map(fn (string $line) => Instruction::fromLine($line));
    }

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
        // TODO: Implement solvePartTwo() method.
    }
}
