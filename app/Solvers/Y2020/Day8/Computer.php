<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day8;

use App\Exceptions\InfiniteLoopException;

class Computer
{
    private Memory $memory;

    private bool $isRunning = false;

    public function __construct(
        private Program $program,
        Memory $memory = null
    ) {
        $this->memory = $memory ?? new Memory();
    }

    public function getMemory(): Memory
    {
        return $this->memory;
    }

    public function run(int $ptr = 0): void
    {
        $this->isRunning = true;
        $visitedInstructions = [];
        while ($this->isRunning) {
            $instruction = $this->program->getInstruction($ptr);

            // Throw when entering a loop
            if (array_key_exists($ptr, $visitedInstructions)) {
                $this->isRunning = false;
                throw new InfiniteLoopException($this->getMemory());
            }
            // Mark instruction so it is not visited twice
            $visitedInstructions[$ptr] = null;

            $ptr = $instruction->execute($this->getMemory(), $ptr);
            $this->isRunning = $ptr > -1;
        }
    }

    public function reset(): void
    {
        $this->isRunning = false;
        $this->memory = new Memory();
    }
}
