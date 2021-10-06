<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day14;

class Emulator
{
    /**
     * @var array<int, string>
     */
    protected array $bitmask = [];

    protected array $memory = [];

    public function updateBitmask(string $bitmask): void
    {
        $newBitmask = [];

        foreach (mb_str_split($bitmask) as $idx => $char) {
            $newBitmask[$idx] = $char;
        }

        $this->bitmask = $newBitmask;
    }

    public function writeToMemory(int $address, int $value): void
    {
        $valueAsBin = $this->convertValueToBinary($value);

        foreach ($this->bitmask as $idx => $mask) {
            if ($mask !== 'X') {
                $valueAsBin[$idx] = $mask;
            }
        }

        $this->memory[$address] = bindec($valueAsBin);
    }

    public function sumMemory(): int
    {
        return array_reduce($this->memory, fn ($acc, $curr) => $acc + $curr, 0);
    }

    protected function convertValueToBinary(int $value): string
    {
        return str_pad(decbin($value), 36, '0', STR_PAD_LEFT);
    }
}
