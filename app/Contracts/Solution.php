<?php

declare(strict_types=1);

namespace App\Contracts;

interface Solution extends Displayable
{
    public function setMeta(string $year, string $day, string $part): void;

    public function value(): mixed;
}
