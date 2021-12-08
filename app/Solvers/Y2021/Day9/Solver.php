<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day9;

use App\Contracts\Solution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getInput(): Stringable
    {
        return $this->read('2021', '9');
    }
}
