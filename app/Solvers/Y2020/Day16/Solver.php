<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day16;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use App\Solvers\Y2020\Day16\Constraints\Constraint;
use App\Solvers\Y2020\Day16\Support\InputParser;
use App\Solvers\Y2020\Day16\Support\ParseResult;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    public function __construct(private InputParser $inputParser)
    {
    }

    private function getInput(): ParseResult
    {
        return $this
            ->inputParser
            ->fromStringable($this->read('2020', '16'));
    }

    protected function solvePartOne(): Solution
    {
        $info = $this->getInput();
        $constraints = $info->getConstraints();
        $scanningErrorRate = $info
            ->getNearbyTickets()
            ->flatten()
            ->reject(function (int $field) use ($constraints) {
                return $constraints->some(fn (Constraint $constraint) => $constraint->isValid($field));
            })
            ->sum();

        return new PrimitiveValueSolution($scanningErrorRate);
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
