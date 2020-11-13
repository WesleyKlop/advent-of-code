<?php


namespace App\Solvers;


use App\Contracts\Solution;
use App\Contracts\Solver;
use App\Exceptions\ApplicationException;

abstract class AbstractSolver implements Solver
{
    protected abstract function solvePartOne(): Solution;

    protected abstract function solvePartTwo(): Solution;

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
