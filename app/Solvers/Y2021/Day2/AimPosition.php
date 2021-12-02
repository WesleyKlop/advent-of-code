<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day2;

class AimPosition extends Position
{
    protected int $aim = 0;

    public function forward(int $amount): void
    {
        $this->x += $amount;
        $this->depth += $amount * $this->aim;
    }

    public function up(int $amount): void
    {
        $this->aim -= $amount;
    }

    public function down(int $amount): void
    {
        $this->aim += $amount;
    }
}
