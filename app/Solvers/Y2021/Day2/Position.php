<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day2;

abstract class Position
{
    protected int $x = 0;

    protected int $depth = 0;

    abstract public function forward(int $amount): void;

    abstract public function up(int $amount): void;

    abstract public function down(int $amount): void;

    public function product(): int
    {
        return $this->x * $this->depth;
    }
}
