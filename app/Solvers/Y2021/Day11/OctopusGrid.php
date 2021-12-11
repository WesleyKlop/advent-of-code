<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day11;

class OctopusGrid
{
    final public const FLASH_THRESHOLD = 9;

    private array $hasFlashedThisStep = [];

    private int $flashes = 0;

    public function __construct(
        private array $octopusGrid
    ) {
    }

    public function incrementAll(): void
    {
        foreach ($this->octopusGrid as $rIdx => $row) {
            foreach ($row as $cIdx => $col) {
                $this->octopusGrid[$rIdx][$cIdx]++;
            }
        }
    }

    public function step(): int
    {
        $this->hasFlashedThisStep = [];
        $this->flashes = 0;
        $this->incrementAll();
        $this->flashOctopuses();
        return $this->flashes;
    }

    public function dump(): void
    {
        foreach ($this->octopusGrid as $row) {
            foreach ($row as $col) {
                echo $col;
            }
            echo "\n";
        }
        echo "\n\n";
    }

    public function size(): int
    {
        return count($this->octopusGrid) * (is_countable($this->octopusGrid[0]) ? count($this->octopusGrid[0]) : 0);
    }

    /**
     * @return iterable<int[]>
     */
    private function neighbours(int $x, int $y): iterable
    {
        $directions = [
            [-1, -1], [-1, 0], [-1, 1],
            [0, -1], [0, 1],
            [1, -1], [1, 0], [1, 1],
        ];
        foreach ($directions as $direction) {
            $neighbourX = $x + $direction[0];
            $neighbourY = $y + $direction[1];
            if (isset($this->octopusGrid[$neighbourX][$neighbourY])) {
                yield [$neighbourX, $neighbourY];
            }
        }
    }

    private function flashOctopuses(): void
    {
        foreach ($this->octopusGrid as $rIdx => $row) {
            foreach ($row as $cIdx => $col) {
                if ($this->shouldFlash($rIdx, $cIdx)) {
                    $this->flash($rIdx, $cIdx);
                }
            }
        }
    }

    private function hasFlashed(int $x, int $y): bool
    {
        return isset($this->hasFlashedThisStep[$x][$y]);
    }

    private function shouldFlash(int $rIdx, int $cIdx): bool
    {
        return ! $this->hasFlashed($rIdx, $cIdx)
            && $this->octopusGrid[$rIdx][$cIdx] > self::FLASH_THRESHOLD;
    }

    private function flash(int $rIdx, int $cIdx): void
    {
        $this->hasFlashedThisStep[$rIdx][$cIdx] = true;
        $this->flashes++;
        foreach ($this->neighbours($rIdx, $cIdx) as [$x, $y]) {
            if (! $this->hasFlashed($x, $y)) {
                $this->octopusGrid[$x][$y]++;
            }
            if ($this->shouldFlash($x, $y)) {
                $this->flash($x, $y);
            }
        }
        $this->octopusGrid[$rIdx][$cIdx] = 0;
    }
}
