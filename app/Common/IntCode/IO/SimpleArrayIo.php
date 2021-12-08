<?php

declare(strict_types=1);

namespace App\Common\IntCode\IO;

use SplDoublyLinkedList;
use SplQueue;

class SimpleArrayIo implements OutputProvider, InputProvider
{
    public SplQueue $data;

    public function __construct()
    {
        $this->data = new SplQueue();
        $this->data->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_DELETE);
    }

    public function read(): int
    {
        return $this->data->pop();
    }

    public function write(int $value): void
    {
        $this->data->enqueue($value);
    }
}
