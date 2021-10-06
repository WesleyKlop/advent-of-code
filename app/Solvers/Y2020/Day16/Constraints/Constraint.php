<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day16\Constraints;

abstract class Constraint
{
    abstract public function isValid(int $value): bool;

    public static function fromString(string $line): static
    {
        preg_match('/^([a-z ]+): ([0-9-]+) or ([0-9-]+)$/', $line, $matches);
        return new NamedConstraint($matches[1], new OrConstraint(
            new RangeConstraint(...explode('-', $matches[2])),
            new RangeConstraint(...explode('-', $matches[3])),
        ));
    }
}
