<?php

declare(strict_types=1);

namespace App\Solvers;

use App\Contracts\Solution;
use App\Contracts\Solver;
use App\Exceptions\ApplicationException;

abstract class AbstractSolver implements Solver
{
    use UsesInput;

    public function solve(int $part): Solution
    {
        return match ($part) {
            Solver::PART_ONE => $this->solvePartOne(),
            Solver::PART_TWO => $this->solvePartTwo(),
            default => throw new ApplicationException(sprintf('Invalid part %d', $part)),
        };
    }

    public function useTestInput(): void
    {
        $this->fileName = 'test.txt';
    }

    abstract protected function solvePartOne(): Solution;

    abstract protected function solvePartTwo(): Solution;
}
