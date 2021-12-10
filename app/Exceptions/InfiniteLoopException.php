<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Solvers\Y2020\Day8\Memory;

final class InfiniteLoopException extends ApplicationException
{
    public function __construct(
        private readonly Memory $memory
    ) {
        parent::__construct('Instruction executed twice');
    }

    public function getMemory(): Memory
    {
        return $this->memory;
    }
}
