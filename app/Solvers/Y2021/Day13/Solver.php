<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day13;

use App\Common\Grid;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        [$grid, $folds] = $this->getInput();

        $grid = $this->fold($grid, $folds[0]);

        return new PrimitiveValueSolution(Grid::countBy($grid, '#'));
    }

    protected function solvePartTwo(): Solution
    {
        [$grid, $folds] = $this->getInput();
        foreach ($folds as $fold) {
            $grid = $this->fold($grid, $fold);
        }
        Grid::dump($grid);
        return new PrimitiveValueSolution(Grid::countBy($grid, '#'));
    }

    private function getInput(): array
    {
        [$points, $rawFolds] = $this->read('2021', '13')
            ->explode("\n\n")
            ->all();
        $map = [];
        foreach (explode("\n", $points) as $coords) {
            [$x, $y] = explode(',', $coords);
            $map[(int) $y][(int) $x] = '#';
        }
        $folds = [];
        foreach (explode("\n", $rawFolds) as $fold) {
            $folds[] = Str::of($fold)
                ->after('fold along ')
                ->explode('=')
                ->all();
        }
        return [
            Grid::expand($map),
            $folds,
        ];
    }

    /**
     * @param array{0: int, 1: string} $fold
     */
    private function fold(array $grid, array $fold): array
    {
        [$axis, $point] = $fold;
        return match ($axis) {
            'x' => $this->foldVertical($grid, (int) $point),
            'y' => $this->foldHorizontal($grid, (int) $point),
        };
    }

    /**
     * Fold along the y axis
     */
    private function foldHorizontal(array $grid, int $point): array
    {
        // Get the array part after the pivot point
        $folded = array_slice($grid, $point + 1);

        // Reverse the array
        $folded = array_reverse($folded);

        // Merge the original over the sliced
        foreach ($folded as $y => $row) {
            foreach ($row as $x => $val) {
                $folded[$y][$x] = $val === '#' ? '#' : ($grid[$y][$x]);
            }
        }

        return $folded;
    }

    private function foldVertical(array $grid, int $point): array
    {
        $folded = array_map(function (array $row) use ($point): array {
            // Get the array part after the pivot point
            $sliced = array_slice($row, $point + 1);

            // Reverse the array
            return array_reverse($sliced);
        }, $grid);

        // Merge the original over the sliced
        foreach ($folded as $y => $row) {
            foreach ($row as $x => $val) {
                $folded[$y][$x] = $val === '#' ? '#' : $grid[$y][$x];
            }
        }

        return $folded;
    }
}
