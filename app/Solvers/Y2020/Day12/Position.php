<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day12;

interface Position
{
    final public const DIRECTION_EAST = 90;

    final public const DIRECTION_SOUTH = 180;

    final public const DIRECTION_WEST = 270;

    final public const DIRECTION_NORTH = 0;

    public function process(string $instruction): self;

    public function manhattanDistance(): int;
}
