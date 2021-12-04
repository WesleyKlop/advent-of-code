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

    public function markBoards(int $number): ?Board
    {
        /** @var \App\Solvers\Y2021\Day4\Board $board */
        foreach ($this->boards as $board) {
            $won = $board->mark($number);
            if ($won === true) {
                return $board;
            }
        }
        return null;
    }
}
