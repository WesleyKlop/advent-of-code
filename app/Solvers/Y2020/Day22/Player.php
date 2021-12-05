<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day22;

use SplDoublyLinkedList;
use SplQueue as Queue;

class Player
{
    private Queue $cards;

    public function __construct(
        private string $name,
        iterable $cards
    ) {
        $this->cards = new Queue();
        $this->cards->setIteratorMode(SplDoublyLinkedList::IT_MODE_DELETE | SplDoublyLinkedList::IT_MODE_FIFO);
        foreach ($cards as $card) {
            $this->cards->enqueue($card);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function countCards(): int
    {
        return $this->cards->count();
    }

    public function popCard(): int
    {
        return $this->cards->dequeue();
    }

    public function addCards(int ...$cards): void
    {
        foreach ($cards as $card) {
            $this->cards->enqueue($card);
        }
    }

    public function score(): int
    {
        $score = 0;
        for ($multiplier = $this->countCards(); $multiplier > 0; $multiplier--) {
            $score += ($multiplier * $this->popCard());
        }
        return $score;
    }
}
