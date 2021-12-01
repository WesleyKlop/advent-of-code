<?php

declare(strict_types=1);

namespace App\Contracts;

interface Solution extends Displayable
{
    public function setMeta(int $year, int $day, int $part): void;

    public function value(): mixed;
}
