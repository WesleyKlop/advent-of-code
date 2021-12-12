<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day12;

class Node
{
    private readonly CaveType $type;

    /**
     * @var array<string, Node>
     */
    private array $connections = [];

    public function __construct(
        private readonly string $cave,
    ) {
        $this->type = CaveType::type($cave);
    }

    public function attach(self $other): void
    {
        $this->connections[$other->cave] = $other;
        $other->connections[$this->cave] = $this;
    }

    public function traverse(array & $root, array $skip = []): void
    {
        if ($this->type === CaveType::SMALL) {
            $skip[$this->cave] = true;
        }

        $root[$this->cave] ??= [];
        if ($this->type === CaveType::END) {
            // Finished!!
            return;
        }
        /** @var Node $connection */
        foreach ($this->connections as $connection) {
            if ($connection->shouldVisit($this, $skip)) {
                $connection->traverse($root[$this->cave], $skip);
            }
        }
    }

    private function shouldVisit(self $from, array $skip): bool
    {
        if ($skip[$this->cave] ?? false) {
            return false;
        }
        if ($this->type === CaveType::START) {
            // We do not want to move back to start
            return false;
        }
        if ($this->type === CaveType::END) {
            return true;
        }
        return $from->type !== CaveType::SMALL || count($this->connections) > 1;
    }
}
