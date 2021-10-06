<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day7;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Str;

class Bag
{
    public function __construct(
        private string $type,
        private string $color,
        private ?\Illuminate\Support\Collection $holds = null
    ) {
    }

    public static function collect(string $spec, array $holdingSpecs): self
    {
        $holds = collect($holdingSpecs)
            ->map(function (string $expression) {
                if (Str::startsWith($expression, 'no other')) {
                    return null;
                }
                return self::holdingBag($expression);
            })
            ->whereNotNull();
        return self::fromExpression($spec, $holds->isEmpty() ? null : $holds);
    }

    public function canContain(self $other): bool
    {
        if ($this->holds === null) {
            return false;
        }

        return $this->holds->some(fn (array $hold) => $hold['bag']->matches($other) ?: $hold['bag']->canContain($other));
    }

    public function matches(self $other): bool
    {
        return $this->getKey() === $other->getKey();
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getKey(): string
    {
        return $this->type . ' ' . $this->color;
    }

    /*
     * Replaces existing references to holdings bags with root ones.
     */
    public function link(Enumerable $rules): self
    {
        if ($this->holds === null) {
            return $this;
        }

        /** @var array $holdingBag */
        foreach ($this->holds as $key => &$holdingBag) {
            $ruleBag = $rules->get($holdingBag['bag']);
            $this->holds->put($key, [
                'bag' => $ruleBag,
                'amount' => $holdingBag['amount'],
            ]);
        }

        return $this;
    }

    public function aggregate(): int
    {
        return 1 + $this->getAmountOfBagsWithin();
    }

    public function print(int $depth = 0, int $amount = 1): void
    {
        for ($i = 0; $i < $depth; $i++) {
            echo ' ';
        }
        echo $amount . ' ' . $this->getKey() . PHP_EOL;
        foreach ($this->holds ?? [] as $hold) {
            $hold['bag']->print($depth + 2, $hold['amount']);
        }
    }

    protected static function fromExpression(string $spec, Collection $holds = null): self
    {
        preg_match("/(?<amount>\d+)? ?(?<type>\w+) (?<color>\w+)/", $spec, $matches);
        return new self(
            $matches['type'],
            $matches['color'],
            $holds,
        );
    }

    private static function holdingBag(string $spec): array
    {
        preg_match("/(?<amount>\d+)? ?(?<type>\w+ \w+)/", $spec, $matches);
        return [
            'bag' => $matches['type'],
            'amount' => (int) $matches['amount'],
        ];
    }

    private function getAmountOfBagsWithin(): int
    {
        if ($this->holds === null) {
            return 0;
        }
        return $this->holds->sum(fn (array $hold) => $hold['amount'] * $hold['bag']->aggregate());
    }
}
