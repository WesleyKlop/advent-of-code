<?php


namespace App\Exceptions;

use App\Solvers\Y2020\Day8\Memory;

final class InfiniteLoopException extends ApplicationException
{
    public function __construct(private Memory $memory)
    {
        parent::__construct("Instruction executed twice");
    }

    public function getMemory(): Memory
    {
        return $this->memory;
    }
}
