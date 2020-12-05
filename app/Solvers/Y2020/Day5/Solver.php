<?php


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
        $this->seats = $this->parseSeats();
    }

    private function parseSeats(): LazyCollection
    {
        return $this
            ->readLazy('2020', '5')
            ->map(function (string $line) {
                preg_match("/^([FB]{7})([LR]{3})$/", $line, $matches);
                $row = $this->calculateSeat($matches[1], 0, 127, 'F', 'B');
                $col = $this->calculateSeat($matches[2], 0, 7, 'L', 'R');

                return [
                    'row' => $row,
                    'col' => $col,
                ];
            });
    }

    protected function solvePartOne(): Solution
    {
        $highestSeatId = $this
            ->seats
            ->map(fn ($seat) => ($seat['row'] * 8 + $seat['col']))
            ->max();

        return new PrimitiveValueSolution($highestSeatId);
    }

    protected function solvePartTwo(): Solution
    {
        $seatIds = $this
            ->seats
            ->map(fn ($seat) => ($seat['row'] * 8 + $seat['col']))
            ->sort();

        $seatKeys = $seatIds->flip();

        for ($i = $seatIds->first(); $i < $seatIds->last(); $i++) {
            if (!$seatKeys->has($i) && $seatKeys->has($i - 1) && $seatKeys->has($i + 1)) {
                return new PrimitiveValueSolution($i);
            }
        }

        throw new AnswerNotFoundException();
    }

    private function calculateSeat(string $queue, int $start, int $end, string $lower, string $upper): int
    {
        if (mb_strlen($queue) === 0) {
            return $start;
        }

        if ($queue[0] === $lower) {
            $end = floor(($end + $start) / 2);
        } elseif ($queue[0] === $upper) {
            $start = ceil(($end + $start) / 2);
        }

        return $this->calculateSeat(substr($queue, 1), $start, $end, $lower, $upper);
    }
}
