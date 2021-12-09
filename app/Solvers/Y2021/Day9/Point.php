<?php

namespace App\Solvers\Y2021\Day9;

class Point
{
    public function __construct(
        private readonly int $value,
        public ?Point $up = null,
        public ?Point $right = null,
        public ?Point $down = null,
        public ?Point $left = null,
    ) {
    }

    public function isLowPoint(): bool
    {
        return $this->value < ($this->up->value ?? 10)
            && $this->value < ($this->right->value ?? 10)
            && $this->value < ($this->down->value ?? 10)
            && $this->value < ($this->left->value ?? 10);
    }

    public function riskLevel(): int
    {
        return $this->value + 1;
    }
}
