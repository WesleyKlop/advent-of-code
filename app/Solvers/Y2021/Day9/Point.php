<?php

namespace App\Solvers\Y2021\Day9;

class Point
{
    public function __construct(
        public readonly int $value,
        public readonly ?int $up,
        public readonly ?int $right,
        public readonly ?int $down,
        public readonly ?int $left
    ) {
    }

    public function isLowPoint(): bool
    {
        return $this->value < ($this->up ?? 10)
            && $this->value < ($this->right ?? 10)
            && $this->value < ($this->down ?? 10)
            && $this->value < ($this->left ?? 10);
    }

    public function riskLevel(): int {
        return $this->value + 1;
    }
}
