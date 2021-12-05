<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day5;

use Illuminate\Support\Str;

class Point
{
    public function __construct(
        public int $x,
        public int $y
    ) {
    }

    public static function fromString(string $point): static
    {
        $coords = Str::of($point)
            ->explode(',')
            ->map(fn (string $coord) => (int) $coord)
            ->toArray();
        return new static(...$coords);
    }
}
