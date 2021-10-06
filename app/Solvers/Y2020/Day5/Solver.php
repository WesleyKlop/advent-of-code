<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day5;

use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Enumerable;
use Illuminate\Support\LazyCollection;

class Solver extends AbstractSolver
{
    private Enumerable $seats;

    public function __construct()
    {
        $this->seats = $this->parseSeatIds();
    }

    protected function solvePartOne(): Solution
    {
        $highestSeatId = $this->seats->max();

        return new PrimitiveValueSolution($highestSeatId);
    }

    protected function solvePartTwo(): Solution
    {
        $seatIds = $this->seats->sort();

        $seatKeys = $seatIds->flip();

        for ($i = $seatIds->first(); $i < $seatIds->last(); $i++) {
            if (! $seatKeys->has($i) && $seatKeys->has($i - 1) && $seatKeys->has($i + 1)) {
                return new PrimitiveValueSolution($i);
            }
        }

        throw new AnswerNotFoundException();
    }

    private function parseSeatIds(): LazyCollection
    {
        return $this
            ->readLazy('2020', '5')
            ->map(fn (string $line) => [
                'row' => $this->stringToInteger(substr($line, 0, 7), 'F', 'B'),
                'col' => $this->stringToInteger(substr($line, 7), 'L', 'R'),
            ])
            ->map(fn ($seat) => ($seat['row'] * 8 + $seat['col']));
    }

    private function stringToInteger(string $value, string $lower, string $upper): int
    {
        $map = [
            $lower => '0',
            $upper => '1',
        ];
        $binary = collect(str_split($value))
            ->map(fn ($char) => $map[$char])
            ->join('');

        return intval($binary, 2);
    }
}
