<?php

declare(strict_types=1);

namespace App\Common\IntCode;

class Program
{
    private array $writeLayer = [];

    public function __construct(
        private array $instructions
    ) {
    }

    public function reset(): void
    {
        $this->writeLayer = [];
    }

    public static function noop(): static
    {
        return new static([99]);
    }

    public function write(int $address, int $value): void
    {
        $this->writeLayer[$address] = $value;
    }

    public function read(int $address): int
    {
        return $this->writeLayer[$address] ?? $this->instructions[$address];
    }

    public function readMany(int $startAddress, int $length): \Generator
    {
        foreach (range($startAddress, $startAddress + $length) as $address) {
            yield $this->read($address);
        }
    }

    public function dump(): void
    {
        dump(join(',', $this->instructions));
    }
}
