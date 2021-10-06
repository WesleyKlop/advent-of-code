<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day8\Instructions;

use App\Solvers\Y2020\Day8\Memory;

interface Instruction
{
    public const JUMP = 'jmp';

    public const ACC = 'acc';

    public const NOOP = 'nop';

    public function execute(Memory $memory, int $ptr): int;

    public function transform(string $class): self;

    public function print(): void;
}
