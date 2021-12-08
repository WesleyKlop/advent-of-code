<?php

declare(strict_types=1);

namespace App\Common\IntCode\IO;

interface OutputProvider
{
    public function write(int $value): void;
}
