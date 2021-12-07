<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day7;

use App\Contracts\HasProgressBar;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class Solver extends AbstractSolver implements HasProgressBar
{
    private ProgressBar $progressBar;

    public function setProgressBar(ProgressBar $progressBar): void
    {
        $this->progressBar = $progressBar;
    }

    protected function solvePartOne(): Solution
    {
        $crabPositions = $this->getInput();
        $targetPosition = $crabPositions->median();
        $totalFuelCost = 0;

        foreach ($crabPositions as $crabPosition) {
            $totalFuelCost += abs($crabPosition - $targetPosition);
        }

        return new PrimitiveValueSolution($totalFuelCost);
    }

    protected function getRange(Collection $collection): array
    {
        return range($collection->min(), $collection->max());
    }

    protected function solvePartTwo(): Solution
    {
        $crabPositions = $this->getInput();
        $bestCost = PHP_INT_MAX;

        $range = $this->getRange($crabPositions);
        $this->progressBar->start(count($range));
        foreach ($range as $targetPosition) {
            $cost = 0;
            foreach ($crabPositions as $crabPosition) {
                $cost += $this->calculateFuelCost($crabPosition, $targetPosition);
            }
            $bestCost = min($cost, $bestCost);
            $this->progressBar->advance();
        }
        $this->progressBar->clear();

        return new PrimitiveValueSolution($bestCost);
    }

    private function getInput(): Collection
    {
        return $this->read('2021', '7')
            ->explode(',')
            ->map(fn ($value): int => (int) $value);
    }

    private function calculateFuelCost(int $crabPosition, int $targetPosition): int
    {
        $steps = abs($crabPosition - $targetPosition);
        // Gaussian sum formula
        return (int) ($steps * ($steps + 1) / 2);
    }
}
