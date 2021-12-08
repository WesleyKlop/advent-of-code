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

    public function readMany(int $startAddress, int $length): \Generator
    {
        foreach (range($startAddress, $startAddress + $length) as $address) {
            yield $this->read($address);
        }
    }

    public function read(int $address, ParameterMode $mode = ParameterMode::POSITION): int
    {
        return match ($mode) {
            ParameterMode::IMMEDIATE => $this->readImmediate($address),
            ParameterMode::POSITION => $this->readPosition($address),
        };
    }

    public function dump(): void
    {
        /** @noinspection ForgottenDebugOutputInspection */
        dump(implode(',', array_merge(
            [],
            $this->instructions,
            $this->writeLayer,
        )));
    }

    public function readPosition(int $address): int
    {
        $value = $this->writeLayer[$address] ?? $this->instructions[$address];
        dump("Position read at ${address} (${value})");
        return $value;
    }

    private function readImmediate(int $address): int
    {
        dump("Immediate read at ${address} (${address})");
        return $address;
    }
}
