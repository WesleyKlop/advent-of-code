<?php


namespace App\Solvers\Y2020\Day11;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $strategy = new PartOneStrategy();
        $prevState = Map::fromStringable($strategy, $this->read('2020', '11'));
        do {
            $currState = $prevState->flip();

            if ($prevState->matches($currState)) {
                return new PrimitiveValueSolution($currState->countOccupied());
            }

            $prevState = $currState;
        } while (true);
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
