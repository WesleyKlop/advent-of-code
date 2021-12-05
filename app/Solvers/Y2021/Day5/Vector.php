<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day5;

use Illuminate\Support\Str;

class Vector
{
    public function __construct(
        private Point $from,
        private Point $to
    ) {
    }

    /**
     * Generate a list of points between the two points.
     * @return iterable<Point>
     */
    public function points(): iterable
    {
        foreach (range($this->from->x, $this->to->x) as $x) {
            foreach (range($this->from->y, $this->to->y) as $y) {
                yield new Point($x, $y);
            }
        }
    }

    public function isDiagonal(): bool
    {
        return $this->from->x !== $this->to->x && $this->from->y !== $this->to->y;
    }

    public static function fromString(string $input): static
    {
        $points = Str::of($input)
            ->explode(' -> ')
            ->map(fn ($point) => Point::fromString($point))
            ->toArray();
        return new static(...$points);
    }

    public function applyToGrid(array & $grid): void
    {
        foreach ($this->points() as $point) {
            $grid[$point->x][$point->y] ??= 0;
            ++$grid[$point->x][$point->y];
        }
    }
}
