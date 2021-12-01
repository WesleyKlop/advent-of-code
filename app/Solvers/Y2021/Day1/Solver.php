<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day1;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function getInput(): Collection
    {
        return $this->read('2021', '1')
            ->explode("\n");
    }

    protected function solvePartOne(): Solution
    {
        $prevDepth = null;
        $incrementations = 0;
        foreach ($this->getInput() as $i => $depth) {
            if($prevDepth !== null && $depth > $prevDepth) {
                ++$incrementations;
            }
            $prevDepth = $depth;
        }
        return new PrimitiveValueSolution($incrementations);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
