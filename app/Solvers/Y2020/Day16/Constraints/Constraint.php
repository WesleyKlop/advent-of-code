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
            static::explodeMatchesIntoRange($matches[2]),
            static::explodeMatchesIntoRange($matches[3]),
        ));
    }

    private static function explodeMatchesIntoRange(string $match): RangeConstraint
    {
        return new RangeConstraint(...array_map(
            fn ($v) => (int) $v,
            explode('-', $match)
        ));
    }
}
