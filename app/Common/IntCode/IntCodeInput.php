<?php

declare(strict_types=1);

namespace App\Common\IntCode;

use Illuminate\Support\Str;

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

    protected function createProgram(string $raw): Program
    {
        $parsed = Str::of($raw)
            ->explode(',')
            ->map(fn ($value) => (int) $value)
            ->all();
        return new Program($parsed);
    }
}
