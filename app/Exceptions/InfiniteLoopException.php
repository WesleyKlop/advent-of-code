<?php


namespace App\Exceptions;

use App\Solvers\Y2020\Day8\Memory;

final class InfiniteLoopException extends ApplicationException
{
    private Memory $memory;

    public function __construct(Memory $memory)
    {
        parent::__construct("Instruction executed twice");
        $this->memory = $memory;
    }

    public function getMemory(): Memory
    {
        return $this->memory;
    }
}
