<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day5;

use App\Common\IntCode\Computer;
use App\Common\IntCode\IntCodeInput;
use App\Common\IntCode\IO\SimpleArrayIo;
use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
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
        $io = new SimpleArrayIo();
        $computer->attach($io);

        $io->write(1);

        $computer->run();

        return new PrimitiveValueSolution($io->read());
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
