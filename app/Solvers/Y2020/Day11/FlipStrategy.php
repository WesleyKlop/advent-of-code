<?php


namespace App\Solvers\Y2020\Day11;

interface FlipStrategy
{
    public function shouldFlip(Map $map, Tile $tile, int $rowIdx, int $colIdx): bool;
}
