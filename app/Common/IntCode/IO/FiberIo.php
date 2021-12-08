<?php

declare(strict_types=1);

namespace App\Common\IntCode\IO;

use Fiber;
use Throwable;

class FiberIo extends QueueIo
{
    private ?Fiber $client = null;

    /**
     * @throws Throwable
     */
    public function read(): int
    {
        $this->client = Fiber::getCurrent();
        if (empty($this->data)) {
            Fiber::suspend();
        }
        return parent::read();
    }

    /**
     * @throws Throwable
     */
    public function write(int $value): void
    {
        parent::write($value);

        if ($this->client?->isSuspended()) {
            $this->client->resume();
        }
    }
}
