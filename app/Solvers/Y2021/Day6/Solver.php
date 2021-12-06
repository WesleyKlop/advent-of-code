<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day6;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    private int $simulateDays = 0;

    protected function solvePartOne(): Solution
    {
        $this->simulateDays = 80;
        return new PrimitiveValueSolution(
            $this->simulateLanternFish()
        );
    }

    protected function solvePartTwo(): Solution
    {
        $this->simulateDays = 256;
        return new PrimitiveValueSolution(
            $this->simulateLanternFish()
        );
    }

    private function emptyGroup(): Collection
    {
        return collect(range(0, 9))
            ->map(fn () => 0);
    }

    private function getInput(): Collection
    {
        $groups = $this->emptyGroup();
        return $this
            ->read('2021', '6')
            ->explode(',')
            ->reduce(function (Collection $groups, string $fish) {
                $timer = (int) $fish;
                $value = $groups->get($timer, 0);
                $value++;
                return $groups->put($timer, $value);
            }, $groups);
    }

    private function simulateLanternFish(): int
    {
        $input = $this->getInput();
        for ($i = 1; $i <= $this->simulateDays; $i++) {
            $newInput = $this->emptyGroup();
            foreach ($input as $timer => $fishCount) {
                if ($timer === 0) {
                    $newInput[6] += $fishCount;
                    $newInput[8] += $fishCount;
                    continue;
                }
                $newInput[$timer - 1] += $fishCount;
            }
            $input = $newInput;
        }
        return $input->sum();
    }
}
