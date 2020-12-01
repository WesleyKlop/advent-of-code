<?php


namespace App\Solvers;

use App\Contracts\Solution;
use App\Contracts\Solver;
use App\Exceptions\ApplicationException;

abstract class AbstractSolver implements Solver
{
    abstract protected function solvePartOne(): Solution;

    abstract protected function solvePartTwo(): Solution;

    public function solve(string $part): Solution
    {
        switch ($part) {
            case '1':
                return $this->solvePartOne();
            case '2':
                return $this->solvePartTwo();
            default:
                throw new ApplicationException(sprintf("Invalid part %s", $part));
        }
    }
}
