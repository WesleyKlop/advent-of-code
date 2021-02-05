<?php


namespace App\Solvers\Y2020\Day14;

class Emulator
{
    /** @var array<int, string>  */
    private array $bitmask = [];
    private array $memory = [];

    public function updateBitmask(string $bitmask): void
    {
        $newBitmask = [];

        foreach (mb_str_split($bitmask) as $idx => $char) {
            if ($char !== 'X') {
                $newBitmask[$idx] = $char;
            }
        }

        $this->bitmask = $newBitmask;
    }

    public function writeToMemory(int $address, int $value): void
    {
        $valueAsBin = str_pad(decbin($value), 36, "0", STR_PAD_LEFT);

        foreach ($this->bitmask as $idx => $mask) {
            $valueAsBin[$idx] = $mask;
        }

        $this->memory[$address] = bindec($valueAsBin);
    }

    public function sumMemory(): int
    {
        return array_reduce($this->memory, fn ($acc, $curr) => $acc + $curr, 0);
    }
}
