<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day19;

class OrRule implements Rule
{
    /**
     * OrRule constructor.
     * @param array<int, Rule> $rules
     */
    public function __construct(
        private readonly array $rules
    ) {
    }

    public function matches(string $other): bool
    {
        foreach ($this->rules as $rule) {
            if ($rule->matches($other)) {
                return true;
            }
        }
        return false;
    }

    public function compile(string $prepend = '', string $append = ''): iterable
    {
        foreach ($this->rules as $rule) {
            yield from $rule->compile($prepend, $append);
        }
    }
}
