<?php

declare(strict_types=1);

namespace App\Contracts;

interface Solver
{
    final public const PART_ONE = 1;

    final public const PART_TWO = 2;

    public function solve(int $part): Solution;

    public function useTestInput(): void;
}
