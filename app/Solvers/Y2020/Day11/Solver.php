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
        $prevState  = Map::fromStringable($this->read('2020', '11', 'test.txt'));
        do {
            $currState = $prevState->flip();

            if($prevState->matches($currState)) {
                return new PrimitiveValueSolution($currState->countByType(Tile::TYPE_OCCUPIED));
            }
        } while (true);
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
