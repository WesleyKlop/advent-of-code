<?php


namespace App\Solvers\Y2020\Day16\Constraints;

class NamedConstraint extends Constraint
{
    public function __construct(
        private string $name,
        private Constraint $child
    ) {
    }

    public function isValid(int $value): bool
    {
        return $this->child->isValid($value);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
