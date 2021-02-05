<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day16;

use App\Contracts\Solution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function getInput(): mixed
    {
        return $this->read('2020', '16');
    }

    protected function solvePartOne(): Solution
    {
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
