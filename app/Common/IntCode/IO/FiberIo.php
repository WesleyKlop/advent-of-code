<?php

namespace App\Common\IntCode\IO;

class FiberIo extends QueueIo
{
    private ?\Fiber $client = null;

    public function read(): int
    {
        if (empty($this->data)) {
            $this->client = \Fiber::getCurrent();
            \Fiber::suspend();
        }
        return parent::read();
    }

    /** @throws \Throwable */
    public function write(int $value): void
    {
        parent::write($value);

        if ($this->client?->isSuspended()) {
            $this->client->resume();
        }
    }

}
