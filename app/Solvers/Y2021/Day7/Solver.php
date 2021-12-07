<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day7;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    private function getInput(): Collection
    {
        return $this->read('2021', '7')
            ->explode(',')
            ->map(fn($value): int => (int) $value);
    }

    protected function solvePartOne(): Solution
    {
        $input = $this->getInput();
        // Move all the inputs to the median
        $target = $input->median();
        $cost = 0;

        foreach ($input as $crabPosition) {
            $cost += abs($crabPosition - $target);
        }

        return new PrimitiveValueSolution($cost);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
