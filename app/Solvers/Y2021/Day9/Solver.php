<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day9;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
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
        $map = $this->getInput();
        $basins = collect([]);

        /** @var Point $point */
        foreach ($map->points() as $point) {
            if (! $point->isLowPoint()) {
                continue;
            }

            $point->basin = $basins->count() + 1;
            $basins->put($point->basin, 1);
            $this->visitNeighbours($basins, $point);
        }

        $topThree = $basins
            ->sortDesc()
            ->take(3)
            ->reduce(fn ($acc, $curr) => $acc * $curr, 1);
        return new PrimitiveValueSolution($topThree);
    }

    private function getInput(): HeightMap
    {
        $raw = $this->read('2021', '9')
            ->explode("\n")
            ->map(fn (string $line) => str_split($line))
            ->all();
        return new HeightMap($raw);
    }

    private function visitNeighbours(Collection $basins, Point $point, Point $origin = null): void
    {
        foreach ($point->neighbours() as $neighbour) {
            if ($origin === $neighbour || $neighbour->isInBasin() || $neighbour->isWall()) {
                continue;
            }

            $neighbour->basin = $point->basin;
            $basins->put($point->basin, $basins->get($point->basin) + 1);

            $this->visitNeighbours($basins, $neighbour, $point);
        }
    }
}
