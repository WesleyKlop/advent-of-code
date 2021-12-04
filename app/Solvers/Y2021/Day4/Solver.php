<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day4;

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
        $puzzle = $this->getInput();

        foreach ($puzzle->numbers() as $number) {
            $winners = $puzzle->markBoards($number);
            foreach ($winners as $winner) {
                return new PrimitiveValueSolution($winner->sum() * $number);
            }
        }
        return new TodoSolution();
    }

    protected function solvePartTwo(): Solution
    {
        $puzzle = $this->getInput();

        foreach ($puzzle->numbers() as $number) {
            $completedBoards = $puzzle->markBoards($number);
            foreach ($completedBoards as $board) {
                if ($puzzle->boardCount() === 1) {
                    return new PrimitiveValueSolution($board->sum() * $number);
                }
                $puzzle->removeBoard($board);
            }
        }
        throw new AnswerNotFoundException();
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
