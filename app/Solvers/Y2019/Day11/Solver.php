<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day11;

use App\Common\IntCode\Computer;
use App\Common\IntCode\IntCodeInput;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    use IntCodeInput;

    protected function solvePartOne(): Solution
    {
        $computer = new Computer($this->getProgram());
        $robot = new HullPaintingRobot();

        $computer->attach($robot);
        $computer->run();

        return new PrimitiveValueSolution($robot->getPanelsPainted());
    }

    protected function solvePartTwo(): Solution
    {
        $computer = new Computer($this->getProgram());
        $robot = new HullPaintingRobot(PanelColor::WHITE);

        $computer->attach($robot);
        $computer->run();

        return $robot->getSolution();
    }

    private function getInput(): Stringable
    {
        return $this->read('2019', '11');
    }
}
