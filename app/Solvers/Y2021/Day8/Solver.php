<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day8;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    /**
     * Corresponds to how many lines a digit has.
     */
    private const NUMBER_MAP = [
        0 => 6,
        1 => 2,
        2 => 5,
        3 => 5,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 3,
        8 => 7,
        9 => 6,
    ];

    private function getInput(): mixed
    {
        return $this->read('2021', '8')
            ->explode("\n")
            ->map(
                fn(string $row) => Str::of($row)
                    ->explode(" | ")
                    ->map(
                        fn(string $segment) => explode(' ', $segment)
                    )
            );
    }

    protected function solvePartOne(): Solution
    {
        $countByNumber = [];
        $decoder = SegmentDisplayDecoder::make();
        foreach ($this->getInput() as [$signals, $values]) {
            foreach ($values as $digit) {
                $int = $decoder->fitSegment($digit);
                if (! in_array($int, [1, 4, 7, 8], true)) {
                    continue;
                }
                $countByNumber[$int] ??=  0;
                $countByNumber[$int]++;
            }
        }
        return new PrimitiveValueSolution(array_sum($countByNumber));
    }

    protected function solvePartTwo(): Solution
    {
        $decoder = SegmentDisplayDecoder::make();
        foreach ($this->getInput() as [$signals, $values]) {
            foreach ($values as $digit) {
                $decoder->fitSegment($digit);
            }
        }
        dd($decoder);
        return new PrimitiveValueSolution(count($decoder->solved()));
    }
}
