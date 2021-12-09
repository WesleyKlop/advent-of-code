<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day9;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    private function getInput(): HeightMap
    {
        $raw = $this->read('2021', '9')
            ->explode("\n")
            ->map(fn($line) => str_split($line))
            ->all();
        return new HeightMap($raw);
    }

    protected function solvePartOne(): Solution
    {
        $map = $this->getInput();
        $lowPoints = [];

        foreach ($map->points() as $point) {
            if ($point->isLowPoint()) {
                $lowPoints[] = $point->riskLevel();
            }
        }

        return new PrimitiveValueSolution(array_sum($lowPoints));
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
