<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day5;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $grid = [];
        $input = $this
            ->getInput()
            ->reject(fn (Vector $vector) => $vector->isDiagonal());
        /** @var Vector $vector */
        foreach ($input as $vector) {
            $vector->applyToGrid($grid);
        }
        return new PrimitiveValueSolution(
            $this->calculatePointsWhereTwoLinesOverlap($grid)
        );
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getInput(): Collection
    {
        return $this->read('2021', '5')
            ->explode("\n")
            ->map(fn (string $line) => Vector::fromString($line));
    }

    private function calculatePointsWhereTwoLinesOverlap(array $grid): int
    {
        $count = 0;
        foreach ($grid as $row) {
            foreach ($row as $point) {
                if ($point >= 2) {
                    $count++;
                }
            }
        }
        return $count;
    }
}
