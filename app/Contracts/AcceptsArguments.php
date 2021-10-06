<?php

declare(strict_types=1);

namespace App\Contracts;

interface AcceptsArguments
{
    public function acceptArguments(array $arguments): void;
}
