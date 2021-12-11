<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day11;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $grid = $this->getInput();
        $flashes = 0;
        for ($i = 1; $i <= 100; $i++) {
            $flashes += $grid->step();
//            if($i % 10 === 0) {
//            echo "Iteration ${i}\n";
//            $grid->dump();
//            }
        }
        return new PrimitiveValueSolution($flashes);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getInput(): OctopusGrid
    {
        $inp = $this->read('2021', '11')
            ->explode("\n")
            ->map(fn ($line) => str_split($line))
            ->all();
        return new OctopusGrid($inp);
    }
}
