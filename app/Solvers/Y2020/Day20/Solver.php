<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day20;

use App\Contracts\Solution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $tiles = $this->getInput();
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getInput(): Collection
    {
        return $this
            ->read('2020', '20')
            ->explode("\n\n")
            ->mapWithKeys(function (string $tile) {
                $tile = Tile::fromString($tile);
                return [
                    $tile->getId() => $tile,
                ];
            });
    }
}
