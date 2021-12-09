<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day9;

class HeightMap
{
    /**
     * @var list<list<Point>>
     */
    private array $points;

    public function __construct(array $points)
    {
        $this->points = array_map(fn($row) => array_map(fn($i) => new Point((int) $i), $row), $points);
        foreach ($this->points as $rIdx => $rows) {
            foreach ($rows as $cIdx => $point) {
                $point->up ??= $this->get($cIdx, $rIdx - 1);
                $point->right ??= $this->get($cIdx + 1, $rIdx);
                $point->down ??= $this->get($cIdx, $rIdx + 1);
                $point->left ??= $this->get($cIdx - 1, $rIdx);
            }
        }
    }

    public function get(int $x, int $y): ?Point
    {
        $row = $this->points[$y] ?? null;
        return $row[$x] ?? null;
    }

    /**
     * @return iterable<Point>
     */
    public function points(): iterable
    {
        foreach ($this->points as $rows) {
            foreach ($rows as $point) {
                yield $point;
            }
        }
    }

    public function dumpBasins(): void
    {
        $output = '';
        foreach ($this->points as $row) {
            foreach ($row as $point) {
                $output .= ($point->basin ? '#' :'.');
            }
            $output .= "\n";
        }
        dump($output);
    }

    public function dumpValues(): void
    {
        $output = '';
        foreach ($this->points as $row) {
            foreach ($row as $point) {
                $output .= $point->value;
            }
            $output .= "\n";
        }
        dump($output);
    }
}
