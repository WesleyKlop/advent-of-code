<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day2;

class BasePosition extends Position
{
    public function forward(int $amount): void
    {
        $this->x += $amount;
    }

    public function up(int $amount): void
    {
        $this->depth -= $amount;
    }

    public function down(int $amount): void
    {
        $this->depth += $amount;
    }
}
