<?php

declare(strict_types=1);

namespace App\Common\IntCode;

trait IntCodeInput
{
    protected function getProgram(): Program
    {
        $program = $this->getInput()
            ->explode(',')
            ->map(fn ($value) => (int) $value)
            ->all();
        return new Program($program);
    }
}
