<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day11;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        return $this->solveWithStrategy(new PartOneStrategy());
    }

    protected function solvePartTwo(): Solution
    {
        return $this->solveWithStrategy(new PartTwoStrategy());
    }

    private function solveWithStrategy(FlipStrategy $strategy): Solution
    {
        $currState = Map::fromStringable($strategy, $this->read('2020', '11'));
        do {
            $prevState = $currState;
            $currState = $prevState->flip();
        } while (! $prevState->matches($currState));

        return new PrimitiveValueSolution($currState->countOccupied());
    }
}
