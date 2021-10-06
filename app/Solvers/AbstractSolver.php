<?php

declare(strict_types=1);

namespace App\Solvers;

use App\Contracts\Solution;
use App\Contracts\Solver;
use App\Exceptions\ApplicationException;

abstract class AbstractSolver implements Solver
{
    use UsesInput;

    public function solve(string $part): Solution
    {
        return match ($part) {
            '1' => $this->solvePartOne(),
            '2' => $this->solvePartTwo(),
            default => throw new ApplicationException(sprintf('Invalid part %s', $part)),
        };
    }

    abstract protected function solvePartOne(): Solution;

    abstract protected function solvePartTwo(): Solution;
}
