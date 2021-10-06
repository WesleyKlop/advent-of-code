<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day10;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $jolts = 0;
        $adapters = $this->getAdapters()->sort();
        $diffs = [
            1 => 0,
            3 => 1,
        ];
        $prevAdapter = 0;
        foreach ($adapters as $adapter) {
            $diff = $adapter - $prevAdapter;
            $diffs[$diff]++;
            $jolts += $adapter;
            $prevAdapter = $adapter;
        }

        return new PrimitiveValueSolution(array_product($diffs));
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getAdapters(): Collection
    {
        return $this
            ->read('2020', '10')
            ->explode("\n")
            ->map(fn (string $val) => (int) $val);
    }
}
