<?php


namespace App\Solvers\Y2020\Day19;

class StringRule implements Rule
{
    public function __construct(private string $value)
    {
    }

    public function matches(string $other): bool
    {
        return $this->value === $other;
    }

    public function compile(string $prepend = '', string $append = ''): iterable
    {
        yield $prepend . $this->value . $append;
    }
}
