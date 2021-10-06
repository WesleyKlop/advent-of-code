<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day8\Instructions;

abstract class AbstractInstruction implements Instruction
{
    public function __construct(
        protected int $amount
    ) {
    }

    public function transform(string $class): Instruction
    {
        return new $class($this->amount);
    }

    public function print(): void
    {
        dump(static::class . ' ' . $this->amount);
    }
}
