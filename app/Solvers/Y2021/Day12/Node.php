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

    public function traverse(array &$root, array $visited = [], bool $twice = false): void
    {
        $root[$this->cave] ??= [];
        switch ($this->type) {
            case CaveType::SMALL:
                if ($twice === true) {
                    dump("Allowing {$this->cave} to be visited twice");
                    $twice = false;
                } else {
                    $visited[$this->cave] = true;
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
            if ($connection->shouldVisit($this, $visited)) {
                $connection->traverse($root[$this->cave], $visited, $twice);
            }
        }
    }

    private function shouldVisit(self $from, array $skip): bool
    {
        if (isset($skip[$this->cave])) {
            return false;
        }
        if ($this->type === CaveType::START) {
            // We do not want to move back to start
            return false;
        }
        return true;
    }
}
