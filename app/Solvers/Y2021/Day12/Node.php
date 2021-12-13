<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day12;

class Node
{
    public readonly CaveType $type;

    /**
     * @var array<string, Node>
     */
    private array $connections = [];

    public function __construct(
        public readonly string $cave,
    ) {
        $this->type = CaveType::type($cave);
    }

    public function attach(self $other): void
    {
        $this->connections[$other->cave] = $other;
        $other->connections[$this->cave] = $this;
    }

    public function traverse(array & $root, bool & $visitCaveTwice = false, array $seen = []): void
    {
        $root[$this->cave] ??= [];
        switch ($this->type) {
            case CaveType::SMALL:
                if ($visitCaveTwice === true) {
                    dump("Allowing {$this->cave} to be visited twice");
                    $visitCaveTwice = false;
                } else {
                    $seen[$this->cave] = true;
                }
                break;
            case CaveType::END:
                // Finished
                return;
            default:
                break;
        }
        /** @var Node $connection */
        foreach ($this->connections as $connection) {
            if ($connection->shouldVisit($this, $seen)) {
                $connection->traverse($root[$this->cave], $visitCaveTwice, $seen);
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
        return true;
    }
}
