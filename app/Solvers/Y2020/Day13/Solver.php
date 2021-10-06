<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day13;

use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        [$earliestDeparture, $busIds] = $this->getData();
        $busesInService = array_filter($busIds, 'is_numeric');
        $waitingTime = 0;

        do {
            foreach ($busesInService as $busId) {
                if (($earliestDeparture + $waitingTime) % $busId === 0) {
                    return new PrimitiveValueSolution($busId * $waitingTime);
                }
            }
        } while (++$waitingTime);

        throw new AnswerNotFoundException();
    }

    protected function solvePartTwo(): Solution
    {
        [, $busIds] = $this->getData();
        $busesInService = array_filter($busIds, fn ($val) => is_int($val));
        $smallestT = $busesInService[0];

        return new TodoSolution();
    }

    private function getData(): array
    {
        [$earliestDeparture, $busIds] = $this->read('2020', '13')->explode("\n");
        return [
            (int) $earliestDeparture,
            Str::of($busIds)
                ->explode(',')
                ->map(fn (string $val) => $val === 'x' ? $val : (int) $val)
                ->all(),
        ];
    }
}
