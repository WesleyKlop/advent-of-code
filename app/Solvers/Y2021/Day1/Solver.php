<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day1;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        return new PrimitiveValueSolution(
            $this->solveForList($this->getInput())
        );
    }

    protected function solvePartTwo(): Solution
    {
        $input = $this->getInput();
        $windows = $input
            ->map(function (int $depth, int $idx) use ($input) {
                if (! $input->has($idx + 2)) {
                    return false;
                }
                return [
                    $depth,
                    $input->get($idx + 1),
                    $input->get($idx + 2),
                ];
            })
            ->filter()
            ->map(fn (array $val) => array_sum($val));
        return new PrimitiveValueSolution(
            $this->solveForList($windows)
        );
    }

    private function getInput(): Collection
    {
        return $this
            ->read('2021', '1')
            ->explode("\n")
            ->map(fn (string $val) => (int) $val);
    }

    private function solveForList(iterable $list): int
    {
        $prevDepth = null;
        $incrementations = 0;
        foreach ($list as $depth) {
            if ($prevDepth !== null && $depth > $prevDepth) {
                ++$incrementations;
            }
            $prevDepth = $depth;
        }
        return $incrementations;
    }
}
