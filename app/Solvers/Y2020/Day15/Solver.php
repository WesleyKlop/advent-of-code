<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day15;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected string $fileName = 'test.txt';

    private function solveForIterations(int $iterations): int
    {
        /** @var int[][] $cache */
        $cache = [];

        foreach ([0, ...$this->getInput()] as $i => $turn) {
            $cache[$turn] = [$i];
        }

        $lastNumberSpoken = $turn;
        for ($turn = $i + 1; $turn <= $iterations; $turn++) {
            $numberOccurrences = $cache[$lastNumberSpoken];

            // Calculate diff between last occurrence, or 0 when not eno
            $occurrenceDiff = count($numberOccurrences) === 2
                ? $numberOccurrences[1] - $numberOccurrences[0]
                : 0;

            $cache[$occurrenceDiff] ??= [];
            $cache[$occurrenceDiff][] = $turn;

            $cache[$occurrenceDiff] = array_slice($cache[$occurrenceDiff], -2);

            $lastNumberSpoken = $occurrenceDiff;
        }

        // Turns are zero-index so we should do iterations - 1
        return $lastNumberSpoken;
    }

    protected function solvePartOne(): Solution
    {
        $solution = $this->solveForIterations(2020);

        return new PrimitiveValueSolution($solution);
    }

    protected function solvePartTwo(): Solution
    {
        $solution = $this->solveForIterations(30_000_000);

        return new PrimitiveValueSolution($solution);
    }

    private function getInput(): array
    {
        return $this->read('2020', '15')
            ->explode(',')
            ->map(fn (string $value) => (int) $value)
            ->all();
    }
}
