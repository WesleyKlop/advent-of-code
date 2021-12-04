<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day4;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Str;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $puzzle = $this->getInput();

        foreach ($puzzle->numbers() as $number) {
            $winner = $puzzle->markBoards($number);
            if ($winner) {
                return new PrimitiveValueSolution($winner->sum() * $number);
            }
        }
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    private function getInput(): PuzzleInput
    {
        $boards = $this
            ->read('2021', '4')
            ->explode("\n\n");
        $numbers = Str::of($boards->shift(1))
            ->explode(',')
            ->transform(fn ($int) => (int) $int);
        return new PuzzleInput(
            $numbers,
            $boards->mapInto(Board::class)
        );
    }
}
