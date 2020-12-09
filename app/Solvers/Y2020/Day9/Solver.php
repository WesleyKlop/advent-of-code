<?php


namespace App\Solvers\Y2020\Day9;


use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    private const PREAMBLE = 25;
    private const TARGET = 57195069;

    protected function solvePartOne(): Solution
    {
        $source = $this
            ->readLazy('2020', '9')
            ->map(fn(string $line) => (int)$line);
        $sourceCount = $source->count();

        for($i = self::PREAMBLE; $i < $sourceCount; $i++) {
            // Consider the previous offset values, one of them MUST be a sum equal the current number
            $verify = $source->get($i);
            $combinations = $source
                ->slice($i - self::PREAMBLE, self::PREAMBLE)
                ->collect();
            $combinations = $combinations->crossJoin($combinations);
            if($combinations->every(fn(array $combo) => $combo[0] + $combo[1] !== $verify)) {
                return new PrimitiveValueSolution($verify);
            }
        }

        throw new AnswerNotFoundException("Could not find any number that is vulnerable");
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
