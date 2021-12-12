<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day12;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $map = CaveSystem::fromConnectionList($this->getInput());
        return new PrimitiveValueSolution($map->countPaths());
    }

    protected function solvePartTwo(): Solution
    {
        $map = CaveSystem::fromConnectionList($this->getInput());
        $count = $map->countPathsVisitOneCaveTwice();
        dump($count);
        return new PrimitiveValueSolution($count);
    }

    private function getInput(): Collection
    {
        return $this
            ->read('2021', '12')
            ->explode("\n");
    }
}
