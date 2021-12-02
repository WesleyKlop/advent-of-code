<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day17;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $pocketDimension = $this->createPocketDimension();

        for ($i = 0; $i < 6; $i++) {
            $pocketDimension = $pocketDimension->cycle();
        }

        return new PrimitiveValueSolution($pocketDimension->countActiveCubes());
    }

    protected function solvePartTwo(): Solution
    {
        $this->overrideFileName('test.txt');
        $pocketDimension = $this->createPocketDimension(4);

        for ($i = 0; $i < 6; $i++) {
            $pocketDimension = $pocketDimension->cycle();
        }

        return new PrimitiveValueSolution($pocketDimension->countActiveCubes());
    }

    private function createPocketDimension(int $dimensions = 3): PocketDimension
    {
        $input = $this->read('2020', '17');
        return PocketDimension::fromStringable($input);
    }
}
