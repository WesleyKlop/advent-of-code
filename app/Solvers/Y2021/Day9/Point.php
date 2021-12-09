<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day9;

class Point
{
    public ?Point $up = null;

    public ?Point $right = null;

    public ?Point $down = null;

    public ?Point $left = null;

    public ?int $basin = null;

    public function __construct(
        public readonly int $value,
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

    /**
     * @return iterable<Point>
     */
    public function neighbours(): iterable
    {
        foreach ([$this->up, $this->right, $this->down, $this->left] as $point) {
            if ($point instanceof self) {
                yield $point;
            }
        }
    }

    public function isInBasin(): bool
    {
        return $this->basin !== null;
    }

    public function isWall(): bool
    {
        return $this->value === 9;
    }
}
