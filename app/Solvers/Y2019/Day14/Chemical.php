<?php


namespace App\Solvers\Y2019\Day14;

class Chemical
{
    private string $type;
    private int $amount;

    public const ORE = 'ORE';
    public const FUEL = 'FUEL';

    public function __construct(string $output)
    {
        [$amount, $type] = explode(' ', $output);

        $this->amount = $amount;
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
        return $this->type === Chemical::ORE;
    }
}
