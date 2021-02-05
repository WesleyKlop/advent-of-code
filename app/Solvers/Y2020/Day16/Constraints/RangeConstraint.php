<?php


namespace App\Solvers\Y2020\Day16\Constraints;

class RangeConstraint extends Constraint
{
    public function __construct(private int $lower, private int $upper)
    {
    }

    public function isValid(int $value): bool
    {
        return $value >= $this->lower && $value <= $this->upper;
    }
}
