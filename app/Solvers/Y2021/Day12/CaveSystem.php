<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day12;

use Illuminate\Support\Collection;

class CaveSystem
{
    /**
     * @var array<string, Node>
     */
    private array $nodes = [];

    public static function fromConnectionList(Collection $connections): static
    {
        $system = new static();

        foreach ($connections as $connection) {
            $system->addConnection(...explode('-', $connection));
        }

        return $system;
    }

    public function countPaths(bool $visitCaveTwice = false): int
    {
        /** @var Node $start */
        $start = $this->nodes['start'];
        $root = [
            'start' => [],
        ];
        $start->traverse($root, twice: $visitCaveTwice);
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator($root),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        $count = 0;
        foreach ($iterator as $key => $value) {
            if ($key === 'end') {
                $count++;
            }
        }
        return $count;
    }

    public function countPathsVisitOneCaveTwice(): int
    {
        return $this->countPaths(true);
    }

    private function addConnection(string $a, string $b): void
    {
        if (! isset($this->nodes[$a])) {
            $this->nodes[$a] = new Node($a);
        }
        if (! isset($this->nodes[$b])) {
            $this->nodes[$b] = new Node($b);
        }
        $this->nodes[$a]->attach($this->nodes[$b]);
    }
}
