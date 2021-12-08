<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day5;

use App\Common\IntCode\Computer;
use App\Common\IntCode\IntCodeInput;
use App\Common\IntCode\IO\QueueIo;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    use IntCodeInput;

    protected function getInput(): Stringable
    {
        return $this->read('2019', '5');
    }

    protected function solvePartOne(): Solution
    {
        $program = $this->getProgram();
        $computer = new Computer($program);
        $io = QueueIo::from([1]);
        $computer->attach($io);

        $computer->run();

        return new PrimitiveValueSolution(last($io->view()));
    }

    protected function solvePartTwo(): Solution
    {
        $program = $this->getProgram();
        $computer = new Computer($program);
        $io = QueueIo::from([5]);
        $computer->attach($io);

        $computer->run();

        return new PrimitiveValueSolution($io->read());
    }
}
