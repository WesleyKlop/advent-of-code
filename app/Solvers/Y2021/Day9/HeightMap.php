<?php

namespace App\Solvers\Y2021\Day9;

class HeightMap
{
    public function __construct(private array $points)
    {
    }

    public function get(int $x, int $y): ?int
    {
        $row = $this->points[$y] ?? null;
        return $row[$x] ?? null;
    }

    /** @return iterable<Point> */
    public function points(): iterable
    {
        foreach ($this->points as $rIdx => $rows) {
            foreach ($rows as $cIdx => $point) {
                yield new Point(
                    $point,
                    $this->get($cIdx, $rIdx - 1),
                    $this->get($cIdx + 1, $rIdx),
                    $this->get($cIdx, $rIdx + 1),
                    $this->get($cIdx - 1, $rIdx)
                );
            }
        }
    }
}
