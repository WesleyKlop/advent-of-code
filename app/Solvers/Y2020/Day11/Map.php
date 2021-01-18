<?php


namespace App\Solvers\Y2020\Day11;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Map
{
    /**
     * @var Tile[][]
     */
    private array $map;

    private FlipStrategy $flipStrategy;

    /**
     * Map constructor.
     * @param FlipStrategy $flipStrategy
     * @param array $map
     */
    public function __construct(FlipStrategy $flipStrategy, array $map)
    {
        $this->map = $map;
        $this->flipStrategy = $flipStrategy;
    }

    public static function fromStringable(FlipStrategy $flipStrategy, Stringable $stringable): Map
    {
        $map = $stringable
            ->explode("\n")
            ->map(fn (string $row) => Str::of($row)->split(1)->mapInto(Tile::class));

        return new Map($flipStrategy, $map->toArray());
    }

    public static function fromString(FlipStrategy $flipStrategy, string $mapString): Map
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

    public function matches(Map $other): bool
    {
        foreach ($this->map as $rowIdx => $row) {
            foreach ($row as $colIdx => $tile) {
                if (!$other->getTile($rowIdx, $colIdx)->equals($tile)) {
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

    public function flip(): Map
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

    private function shouldFlip(int $rowIdx, int $colIdx, Tile $tile): bool
    {
        return $this->flipStrategy->shouldFlip($this, $tile, $rowIdx, $colIdx);
    }

    private function applyFlip(array $flipList): Map
    {
        $newMap = $this->map;


        foreach ($flipList as [$rowIdx, $colIdx]) {
            $newMap[$rowIdx][$colIdx] = $this->getTile($rowIdx, $colIdx)->flip();
        }

        return new static($this->flipStrategy, $newMap);
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
}
