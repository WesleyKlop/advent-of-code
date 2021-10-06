<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day8\Instructions;

use App\Solvers\Y2020\Day8\Memory;

class JmpInstruction extends AbstractInstruction
{
    public function execute(Memory $memory, int $ptr): int
    {
        return $ptr + $this->amount;
    }
}
