<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day16\Constraints;

class NamedConstraint extends Constraint
{
    public function __construct(
        private readonly string $name,
        private readonly Constraint $child
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
