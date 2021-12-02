<?php

declare(strict_types=1);

namespace App\Solvers\Y2019\Day14;

class Chemical
{
    final public const ORE = 'ORE';

    final public const FUEL = 'FUEL';

    private string $type;

    private int $amount;

    public function __construct(string $output)
    {
        [$amount, $type] = explode(' ', $output);

        $this->amount = intval($amount);
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function isBaseChemical(): bool
    {
        return $this->type === self::ORE;
    }
}
