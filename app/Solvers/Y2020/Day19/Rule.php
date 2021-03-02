<?php


namespace App\Solvers\Y2020\Day19;

interface Rule
{
    public function matches(string $other): bool;

    public function compile(string $prepend = '', string $append = ''): iterable;
}
