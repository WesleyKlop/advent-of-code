<?php


namespace App\Solvers\Y2020\Day8\Instructions;

abstract class AbstractInstruction implements Instruction
{
    protected int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function transform(string $class): Instruction
    {
        return new $class($this->amount);
    }

    public function print(): void
    {
        dump(static::class . " " . $this->amount);
    }
}
