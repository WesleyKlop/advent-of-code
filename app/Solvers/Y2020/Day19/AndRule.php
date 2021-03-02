<?php


namespace App\Solvers\Y2020\Day19;

use App\Exceptions\ApplicationException;

class AndRule implements Rule
{
    /**
     * AndRule constructor.
     * @param array<int, Rule> $rules
     */
    public function __construct(private array $rules)
    {
    }

    public function matches(string $other): bool
    {
        throw new ApplicationException("dunno");
    }

    public function compile(string $prepend = '', string $append = ''): iterable
    {
        return $this->compileRule(0, $prepend, $append);
    }

    private function compileRule(int $i, string $prepend, string $append): iterable
    {
        if ($i === count($this->rules)) {
            yield $prepend . $append;
            return;
        }
        foreach ($this->rules[$i]->compile($prepend) as $pattern) {
            yield from $this->compileRule($i + 1, $pattern, $append);
        }
    }
}
