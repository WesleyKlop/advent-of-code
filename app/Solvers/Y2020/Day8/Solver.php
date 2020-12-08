<?php


namespace App\Solvers\Y2020\Day8;

use App\Contracts\Solution;
use App\Exceptions\ApplicationException;
use App\Exceptions\InfiniteLoopException;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use App\Solvers\Y2020\Day8\Instructions\AccInstruction;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $program = Program::fromStringable($this->read('2020', '8', 'input.txt'));
        $computer = new Computer($program);

        try {
            $computer->run();
        } catch (InfiniteLoopException $exception) {
            return new PrimitiveValueSolution($exception->getMemory()->getAccumulator());
        }

        throw new ApplicationException("Could not find value");
    }

    protected function solvePartTwo(): Solution
    {
        $program = Program::fromStringable($this->read('2020', '8', 'input.txt'));
        $computer = new Computer($program);
        $instructionToFlip = 0;
        while ($instructionToFlip < $program->lastIndex()) {
            if ($program->getInstruction($instructionToFlip) instanceof AccInstruction) {
                $instructionToFlip++;
                continue;
            }

            // Flip to try and fix instruction
            $program->flipInstruction($instructionToFlip);

            try {
                $computer->run();
            } catch (InfiniteLoopException $exception) {
                // Restore instruction
                $program->flipInstruction($instructionToFlip);
                $computer->reset();
                $instructionToFlip++;
                continue;
            }

            return new PrimitiveValueSolution($computer->getMemory()->getAccumulator());
        }
    }
}
