<?php


namespace App\Solvers\Y2020\Day11;

class PartTwoStrategy implements FlipStrategy
{
    private const POSITIONS_TO_CHECK = [
        [-1, -1], [-1, 0], [-1, 1],
        [0, -1], [0, 1],
        [1, -1], [1, 0], [1, 1],
    ];

    protected function countOccupiedSeats(Map $map, int $cy, int $cx): int
    {
        $occupiedSeats = 0;
        foreach (self::POSITIONS_TO_CHECK as [$dy, $dx]) {
            $currY = $cy + $dy;
            $currX = $cx + $dx;
            while ($tile = $map->getTile($currY, $currX)) {
                if (!$tile->isFloor()) {
                    break;
                }

                $currY += $dy;
                $currX += $dx;
            }

            if ($tile !== null && $tile->isOccupied()) {
                $occupiedSeats++;
            }
        }
        return $occupiedSeats;
    }

    public function shouldFlip(Map $map, Tile $tile, int $rowIdx, int $colIdx): bool
    {
        $occupiedSeats = $this->countOccupiedSeats($map, $rowIdx, $colIdx);

        return ($tile->isEmpty() && $occupiedSeats === 0)
            || ($tile->isOccupied() && $occupiedSeats >= 5);
    }
}
