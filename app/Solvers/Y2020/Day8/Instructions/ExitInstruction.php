<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day8\Instructions;

use App\Solvers\Y2020\Day8\Memory;

class ExitInstruction extends AbstractInstruction
{
    public function __construct()
    {
        parent::__construct(1337);
    }

    public function execute(Memory $memory, int $ptr): int
    {
        return -1;
    }
}
