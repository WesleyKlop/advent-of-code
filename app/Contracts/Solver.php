<?php

declare(strict_types=1);

namespace App\Contracts;

interface Solver
{
    public const PART_ONE = '1';

    public const PART_TWO = '2';

    public function solve(string $part): Solution;
}
