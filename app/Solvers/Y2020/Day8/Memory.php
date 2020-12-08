<?php


namespace App\Solvers\Y2020\Day8;

class Memory
{
    private int $accumulator;

    public function __construct(int $accumulator = 0)
    {
        $this->accumulator = $accumulator;
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
