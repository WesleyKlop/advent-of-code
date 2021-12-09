<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day9;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

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
        /** @var array<int, int> $basins */
        $basins = [];
        $basinId = 1;

        /** @var Point $point */
        foreach ($map->points() as $point) {
            if (! $point->isLowPoint()) {
                continue;
            }

            $point->basin = $basinId++;
            $basins[$point->basin] = 1;
            $this->visitNeighbours($basins, $point);
        }

        sort($basins);
        dump($basins);
        $topThree = array_slice($basins, -3);
        $map->dumpBasins();
        $map->dumpValues();
        return new PrimitiveValueSolution(array_product($topThree));
    }

    private function getInput(): HeightMap
    {
        $raw = $this->read('2021', '9')
            ->explode("\n")
            ->map(fn(string $line) => str_split($line))
            ->all();
        return new HeightMap($raw);
    }

    /**
     * @param array<int, int> $basins
     */
    private function visitNeighbours(array &$basins, Point $point, Point $origin = null): void
    {
        foreach ($point->neighbours() as $neighbour) {
            if ($origin === $neighbour || $neighbour->isInBasin() || $neighbour->isWall()) {
                continue;
            }

            $neighbour->basin = $point->basin;
            $basins[$point->basin]++;

            $this->visitNeighbours($basins, $neighbour, $point);
        }
    }
}
