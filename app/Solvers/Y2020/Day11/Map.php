<?php


namespace App\Solvers\Y2020\Day11;


use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class Map
{
    /**
     * @var Tile[][]
     */
    private array $map = [];

    /**
     * Map constructor.
     * @param array $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public static function fromStringable(Stringable $stringable): Map
    {
        $map = $stringable
            ->explode("\n")
            ->map(fn(string $row) => Str::of($row)->split(1)->mapInto(Tile::class));

        return new Map($map->toArray());
    }

    public function dump()
    {
        $str = '';
        foreach($this->map as $row) {
            foreach($row as $char) {
                $str .= $char->getType();
            }
            $str .= "\n";
        }
        dump($str);
    }

    public function matches(Map $other): bool
    {
        foreach($this->map as $rowIdx => $row) {
            foreach ($row as $colIdx => $col) {
                if($other->get($rowIdx, $colIdx) !== $col) {
                    return false;
                }
            }
        }
        return true;
    }

    private function get(int $rowIdx, int $colIdx): Tile
    {
        return $this->map[$rowIdx][$colIdx];
    }

    private function getRow(int $rowIdx): array {
        return $this->map[$rowIdx];
    }

    public function flip(): Map
    {
        // Get a list of coordinates that we would want to flip
        $toFlip = [];
        foreach ($this->map as $rowIdx => $row) {
            foreach($row as $colIdx => $tile) {
            }
        }

    }
}
