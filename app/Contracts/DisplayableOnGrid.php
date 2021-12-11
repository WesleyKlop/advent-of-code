<?php

declare(strict_types=1);

namespace App\Contracts;

interface DisplayableOnGrid
{
    final public const FULL_BLOCK = '█';

    public function character(): string;
}
