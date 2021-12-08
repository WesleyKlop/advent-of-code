<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day2;

use App\Common\IntCode\Computer;
use App\Common\IntCode\IntCodeInput;
use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Stringable;

class Solver extends AbstractSolver
{
    use IntCodeInput;

    protected function getInput(): Stringable
    {
        return $this->read('2019', '2');
    }

    protected function solvePartOne(): Solution
    {
        $program = $this->getProgram();
        $program->write(1, 12);
        $program->write(2, 2);

        $computer = new Computer($program);
        $computer->run();

        return new PrimitiveValueSolution($program->read(0));
    }

    protected function solvePartTwo(): Solution
    {
        $target = 19_690_720;
        $program = $this->getProgram();
        $computer = new Computer($program);
        foreach (range(0, 99) as $noun) {
            foreach (range(0, 99) as $verb) {
                $computer->reset();
                $program->write(1, $noun);
                $program->write(2, $verb);
                $computer->run();
                if ($program->read(0) === $target) {
                    return new PrimitiveValueSolution($noun * 100 + $verb);
                }
            }
        }
        throw new AnswerNotFoundException('Failed to execute intcode program');
    }
}
