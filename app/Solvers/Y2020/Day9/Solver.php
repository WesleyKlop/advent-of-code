<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day9;

use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    private const PREAMBLE = 25;

    private const TARGET = 57195069;

    protected function solvePartOne(): Solution
    {
        $source = $this
            ->readLazy('2020', '9')
            ->map(fn (string $line) => (int) $line);
        $sourceCount = $source->count();

        for ($i = self::PREAMBLE; $i < $sourceCount; $i++) {
            // Consider the previous offset values, one of them MUST be a sum equal the current number
            $verify = $source->get($i);
            $combinations = $source
                ->slice($i - self::PREAMBLE, self::PREAMBLE)
                ->collect();
            $combinations = $combinations->crossJoin($combinations);
            if ($combinations->every(fn (array $combo) => $verify !== $combo[0] + $combo[1])) {
                return new PrimitiveValueSolution($verify);
            }
        }

        throw new AnswerNotFoundException('Could not find any number that is vulnerable');
    }

    protected function solvePartTwo(): Solution
    {
        $source = $this
            ->readLazy('2020', '9')
            ->map(fn (string $line) => (int) $line);

        $lowerBoundIndex = 0;
        $upperBoundIndex = 1;

        while (true) {
            $window = $source->slice($lowerBoundIndex, $upperBoundIndex - $lowerBoundIndex);
            $sum = $window->sum();
            if ($sum === self::TARGET) {
                return new PrimitiveValueSolution($window->min() + $window->max());
            }
            if ($sum < self::TARGET) {
                $upperBoundIndex++;
            } elseif ($sum > self::TARGET) {
                $lowerBoundIndex++;
            }
        }

        throw new AnswerNotFoundException('Could not find any number that is vulnerable');
    }
}
