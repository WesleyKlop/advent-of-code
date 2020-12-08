<?php


namespace App\Solvers\Y2020\Day8\Instructions;

use App\Solvers\Y2020\Day8\Memory;

class AccInstruction extends AbstractInstruction
{
    public function execute(Memory $memory, int $ptr): int
    {
        $memory->modifyAccumulator($this->amount);
        return $ptr + 1;
    }
}
