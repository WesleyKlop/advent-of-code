<?php

declare(strict_types=1);

namespace App\Common\IntCode\IO;

interface InputProvider
{
    public function read(): int;
}
