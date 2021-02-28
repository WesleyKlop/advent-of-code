<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day18;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\LazyCollection;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function getInput(): LazyCollection
    {
        return $this
            ->readLazy('2020', '18')
            ->map(fn (string $expression) => PostfixExpression::fromString($expression));
    }

    protected function solvePartOne(): Solution
    {
        $result = $this->getInput()
            ->map(fn (PostfixExpression $expression) => $expression->solve())
            ->dump()
            ->sum();
        return new PrimitiveValueSolution($result);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
