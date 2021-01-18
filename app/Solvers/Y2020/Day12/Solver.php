<?php


namespace App\Solvers\Y2020\Day12;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $position = $this->readLazy('2020', '12', 'input.txt')->reduce(fn (
            Position $position,
            string $instruction
        ) => $position->process($instruction), new ShipPosition());

        return new PrimitiveValueSolution($position->manhattanDistance());
    }

    protected function solvePartTwo(): Solution
    {
        $position = $this->readLazy('2020', '12', 'test.txt')->reduce(fn (
            Position $position,
            string $instruction
        ) => $position->process($instruction), new WaypointShipPosition());

        return new PrimitiveValueSolution($position->manhattanDistance());
    }
}
