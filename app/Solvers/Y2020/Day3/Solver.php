<?php


namespace App\Solvers\Y2020\Day3;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    private const INDICATOR_TREE = '#';

    private function traverseMapForTreeCount(int $down, int $right): int
    {
        $map = $this->getMap();
        $mapWidth = count($map->first());
        $treeCount = 0;
        // Move one down and three to the right every step
        for ($y = 0, $x = 0; $y < $map->count(); $y += $down, $x += $right) {
            if ($map[$y][$x % $mapWidth] === self::INDICATOR_TREE) {
                $treeCount += 1;
            }
        }

        return $treeCount;
    }

    protected function solvePartOne(): Solution
    {
        $treeCount = $this->traverseMapForTreeCount(1, 3);

        return new PrimitiveValueSolution($treeCount);
    }

    protected function solvePartTwo(): Solution
    {
        $treeCount = collect([
            [1, 1],
            [3, 1],
            [5, 1],
            [7, 1],
            [1, 2],
        ])->reduce(function ($treeCount, $dir) {
            [$right, $down] = $dir;
            return $treeCount * $this->traverseMapForTreeCount($down, $right);
        }, 1);

        return new PrimitiveValueSolution($treeCount);
    }

    private function getMap(): Collection
    {
        return $this
            ->read('2020', '3')
            ->explode("\n")
            ->map(fn (string $row) => mb_str_split($row));
    }
}
