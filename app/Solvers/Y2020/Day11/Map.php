<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day11;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Map
{
    public function __construct(
        private FlipStrategy $flipStrategy,
        /**
         * @var Tile[][]
         */
        private array $map
    ) {
    }

    public static function fromStringable(FlipStrategy $flipStrategy, Stringable $stringable): self
    {
        $map = $stringable
            ->explode("\n")
            ->map(fn (string $row) => Str::of($row)->split(1)->mapInto(Tile::class));

        return new self($flipStrategy, $map->toArray());
    }

    public static function fromString(FlipStrategy $flipStrategy, string $mapString): self
    {
        return static::fromStringable($flipStrategy, Str::of($mapString));
    }

    public function dump()
    {
        $str = '';
        foreach ($this->map as $row) {
            foreach ($row as $char) {
                $str .= $char->getType();
            }
            $str .= "\n";
        }
        dump($str);
    }

    public function matches(self $other): bool
    {
        foreach ($this->map as $rowIdx => $row) {
            foreach ($row as $colIdx => $tile) {
                if (! $other->getTile($rowIdx, $colIdx)->equals($tile)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getTile(int $rowIdx, int $colIdx): ?Tile
    {
        if (isset($this->map[$rowIdx], $this->map[$rowIdx][$colIdx])) {
            return $this->map[$rowIdx][$colIdx];
        }
        return null;
    }

    public function countOccupied(): int
    {
        return $this->countByType(Tile::TYPE_OCCUPIED);
    }

    public function flip(): self
    {
        $toFlip = [];
        foreach ($this->map as $rowIdx => $row) {
            foreach ($row as $colIdx => $tile) {
                if ($this->shouldFlip($rowIdx, $colIdx, $tile)) {
                    $toFlip[] = [$rowIdx, $colIdx];
                }
            }
        }

        return $this->applyFlip($toFlip);
    }

    public function countByType(string $type): int
    {
        $amount = 0;
        foreach ($this->map as $row) {
            foreach ($row as $tile) {
                if ($tile->getType() === $type) {
                    $amount++;
                }
            }
        }
        return $amount;
    }

    private function shouldFlip(int $rowIdx, int $colIdx, Tile $tile): bool
    {
        return $this->flipStrategy->shouldFlip($this, $tile, $rowIdx, $colIdx);
    }

    private function applyFlip(array $flipList): self
    {
        $newMap = $this->map;

        foreach ($flipList as [$rowIdx, $colIdx]) {
            $newMap[$rowIdx][$colIdx] = $this->getTile($rowIdx, $colIdx)->flip();
        }

        return new static($this->flipStrategy, $newMap);
    }
}
