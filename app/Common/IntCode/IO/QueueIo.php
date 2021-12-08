<?php

declare(strict_types=1);

namespace App\Common\IntCode\IO;

class QueueIo implements OutputProvider, InputProvider
{
    public array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public static function from(array $initial): static
    {
        $instance = new static();
        $instance->data = $initial;
        return $instance;
    }

    public function read(): int
    {
        return array_shift($this->data);
    }

    public function write(int $value): void
    {
        $this->data[] = $value;
    }

    public function view(): array
    {
        return $this->data;
    }
}
