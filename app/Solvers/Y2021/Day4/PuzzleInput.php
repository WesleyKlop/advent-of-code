<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day4;

use Illuminate\Support\Collection;

class PuzzleInput
{
    public function __construct(
        private Collection $numbers,
        private Collection $boards,
    ) {
    }

    public function numbers(): iterable
    {
        return $this->numbers;
    }

    public function markBoards(int $number): array
    {
        $winners = [];
        /** @var \App\Solvers\Y2021\Day4\Board $board */
        foreach ($this->boards as $board) {
            $won = $board->mark($number);
            if ($won === true) {
                $winners[] = $board;
            }
        }
        return $winners;
    }

    public function removeBoard(Board $completedBoard): void
    {
        $originalCount = $this->boards->count();
        $this->boards = $this->boards->reject(
            fn(Board $board) => $board->is($completedBoard)
        );
    }

    public function boardCount(): int
    {
        return $this->boards->count();
    }
}
