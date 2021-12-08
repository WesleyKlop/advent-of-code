<?php

declare(strict_types=1);


namespace App\Solvers\Y2019\Day9;

use App\Common\IntCode\Computer;
use App\Common\IntCode\IntCodeInput;
use App\Common\IntCode\IO\FiberIo;
use App\Common\IntCode\IO\QueueIo;
use App\Common\IntCode\Program;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    use IntCodeInput;

    private function getInput(): Stringable
    {
        return $this->read('2019', '9');
    }

    protected function solvePartOne(): Solution
    {
        $program = $this->getProgram();
//        $program = new Program([109, 1, 203, 2, 204, 2, 99]);
        $io = QueueIo::from([1]);
        $computer = new Computer($program);
        $computer->attach($io);
        $computer->run();
        return new PrimitiveValueSolution(implode(',', $io->view()));
    }

    protected function solvePartTwo(): Solution
    {
        $program = $this->getProgram();
        $io = QueueIo::from([2]);
        $computer = new Computer($program);
        $computer->attach($io);
        $computer->run();
        return new PrimitiveValueSolution(implode(',', $io->view()));
    }
}
