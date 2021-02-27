<?php


namespace App\Solvers\Y2020\Day8;

class Memory
{
    public function __construct(private int $accumulator = 0)
    {
    }

    public function modifyAccumulator(int $amount): void
    {
        $this->accumulator += $amount;
    }

    public function getAccumulator(): int
    {
        return $this->accumulator;
    }
}
