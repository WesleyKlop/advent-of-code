<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day10;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $parser = new NavigationParser();

        $score = $parser->calculateSyntaxErrorScore($this->getInput());

        return new PrimitiveValueSolution($score);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getInput(): Collection
    {
        return $this->read('2021', '10')
            ->explode("\n");
    }
}
