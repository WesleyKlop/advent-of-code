<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day18;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\LazyCollection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $result = $this->getInput()
            ->map(fn (string $expression) => PartOneTokenParser::fromString($expression))
            ->map(fn (Expression $expression) => $expression->solve())
            ->sum();
        return new PrimitiveValueSolution($result);
    }

    protected function solvePartTwo(): Solution
    {
        $result = $this->getInput()
            ->map(fn (string $expression) => PartTwoTokenParser::fromString($expression))
            ->map(fn (Expression $expression) => $expression->solve())
            ->sum();
        return new PrimitiveValueSolution($result);
    }

    private function getInput(): LazyCollection
    {
        return $this->readLazy('2020', '18');
    }
}
