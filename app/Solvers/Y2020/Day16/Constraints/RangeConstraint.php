<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day16\Constraints;

class RangeConstraint extends Constraint
{
    public function __construct(
        private readonly int $lower,
        private readonly int $upper
    ) {
    }

    public function isValid(int $value): bool
    {
        return $value >= $this->lower && $value <= $this->upper;
    }
}
