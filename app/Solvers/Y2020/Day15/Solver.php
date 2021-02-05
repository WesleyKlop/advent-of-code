<?php


namespace App\Solvers\Y2020\Day15;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function solveForIterations(int $iterations): int
    {
        $lastOccurrenceCache = [];
        $turns = ['foobar', ...$this->getInput()];

        for ($i = 1; $i <= $iterations; $i++) {
            if (isset($turns[$i])) {
                $lastOccurrenceCache[$turns[$i]] = [$i];
                continue;
            }

            $lastNumberSpoken = $turns[$i - 1];
            $numberOccurrences = $lastOccurrenceCache[$lastNumberSpoken];

            if (count($numberOccurrences) === 1) {
                array_push($lastOccurrenceCache[0], $i);
                if (count($lastOccurrenceCache[0]) === 3) {
                    array_shift($lastOccurrenceCache[0]);
                }
                $turns[] = 0;
                continue;
            }

            // Calculate diff between last occurence
            $occurrenceDiff = $numberOccurrences[1] - $numberOccurrences[0];

            $lastOccurrenceCache[$occurrenceDiff] ??= [];
            $lastOccurrenceCache[$occurrenceDiff][] = $i;

            if (count($lastOccurrenceCache[$occurrenceDiff]) === 3) {
                array_shift($lastOccurrenceCache[$occurrenceDiff]);
            }
            $turns[] = $occurrenceDiff;
        }

        // Turns are zero-index so we should do iterations - 1
        return $turns[$iterations];
    }

    protected function solvePartOne(): Solution
    {
        $solution = $this->solveForIterations(2020);


        return new PrimitiveValueSolution($solution);
    }

    protected function solvePartTwo(): Solution
    {
        $solution = $this->solveForIterations(30000000);


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
