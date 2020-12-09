<?php


namespace App\Solvers\Y2020\Day9;


use App\Contracts\Solution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{

    protected function solvePartOne(): Solution
    {
        $source = $this->readLazy('2020', '9', 'test.txt')->map(fn(string $line) => intval($line));
        $sourceCount = $source->count();
        // 5 => Offset
        for($i = 5; $i < $sourceCount; $i++) {
            // Consider the previous offset values, one of them MUST be a sum equal the current number
            $verify = $source->get($i);
        }



        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
