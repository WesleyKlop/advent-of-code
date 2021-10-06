<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day12;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        return $this->solveWithPosition(new ShipPosition());
    }

    protected function solvePartTwo(): Solution
    {
        return $this->solveWithPosition(new WaypointShipPosition());
    }

    private function solveWithPosition(Position $initialPosition): Solution
    {
        $finalPosition = $this->readLazy('2020', '12')->reduce(fn (
            Position $position,
            string $instruction
        ) => $position->process($instruction), $initialPosition);

        return new PrimitiveValueSolution($finalPosition->manhattanDistance());
    }
}
