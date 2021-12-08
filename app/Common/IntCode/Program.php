<?php

declare(strict_types=1);

namespace App\Common\IntCode;

class Program
{
    private array $writeLayer = [];

    public function __construct(
        private array $readLayer
    ) {
    }

    public static function noop(): static
    {
        return new static([99]);
    }

    public function reset(): void
    {
        $this->writeLayer = [];
    }

    public function write(int $address, int $value): void
    {
        $this->writeLayer[$address] = $value;
    }

    public function dump(): void
    {
        /** @noinspection ForgottenDebugOutputInspection */
        dump(implode(',', [
            ...$this->readLayer,
            ...$this->writeLayer,
        ]));
    }

    public function read(int $address): int
    {
        return $this->writeLayer[$address] ?? $this->readLayer[$address] ?? 0;
    }
}
