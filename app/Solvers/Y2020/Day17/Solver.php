<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day17;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function createPocketDimension(): PocketDimension
    {
        $input = $this->read('2020', '17');
        return PocketDimension::fromStringable($input);
    }

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
        return new TodoSolution();
    }
}
