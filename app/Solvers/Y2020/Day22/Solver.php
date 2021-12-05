<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day22;

use App\Contracts\Solution;
use App\Exceptions\AnswerNotFoundException;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        [$player1, $player2] = $this->getInput();

        while (true) {
            $card1 = $player1->popCard();
            $card2 = $player2->popCard();
            if ($card1 > $card2) {
                $player1->addCards($card1, $card2);
            } else {
                $player2->addCards($card2, $card1);
            }

            if ($player1->countCards() === 0) {
                return new PrimitiveValueSolution($player2->score());
            }
            if ($player2->countCards() === 0) {
                return new PrimitiveValueSolution($player1->score());
            }
        }

        throw new AnswerNotFoundException();
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }

    /**
     * @return Player[]
     */
    private function getInput(): array
    {
        return $this->read('2020', '22')
            ->explode("\n\n")
            ->map(fn ($player) => $this->parsePlayer($player))
            ->all();
    }

    private function parsePlayer(string $player): Player
    {
        $parsed = explode("\n", $player);
        return new Player(
            array_shift($parsed),
            array_map('intval', $parsed),
        );
    }
}
