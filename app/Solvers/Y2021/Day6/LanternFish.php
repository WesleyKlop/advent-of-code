<?php

namespace App\Solvers\Y2021\Day6;

class LanternFish
{
    public function __construct(private int $timer = 8)
    {
    }

    public function age(): int
    {
        return $this->timer;
    }

    public function generation(): bool
    {
        if ($this->timer === 0) {
            $this->timer = 6;
            return true;
        }

        $this->timer--;
        return false;
    }
}
