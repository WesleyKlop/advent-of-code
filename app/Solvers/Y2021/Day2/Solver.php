<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day2;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\LazyCollection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        return new PrimitiveValueSolution(
            $this->solveForPosition(new BasePosition())
        );
    }

    protected function solvePartTwo(): Solution
    {
        return new PrimitiveValueSolution(
            $this->solveForPosition(new AimPosition())
        );
    }

    private function solveForPosition(Position $position): int
    {
        $this
            ->getInput()
            ->each(function (string $instruction) use ($position) {
                [$direction, $amount] = explode(' ', $instruction);
                $position->{$direction}((int) $amount);
            })
            ->collect();
        return $position->product();
    }

    private function getInput(): LazyCollection
    {
        return $this->readLazy('2021', '2');
    }
}
