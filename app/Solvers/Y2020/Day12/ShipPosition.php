<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day12;

class ShipPosition implements Position
{
    public function __construct(
        protected int $north = 0,
        protected int $east = 0,
        protected int $direction = Position::DIRECTION_EAST
    ) {
    }

    public function manhattanDistance(): int
    {
        return abs($this->east) + abs($this->north);
    }

    public function process(string $instruction): self
    {
        $move = $instruction[0];
        $amount = (int) substr($instruction, 1);

        match ($move) {
            'F' => $this->moveShip($this->direction, $amount),
            'N' => $this->moveShip(Position::DIRECTION_NORTH, $amount),
            'E' => $this->moveShip(Position::DIRECTION_EAST, $amount),
            'W' => $this->moveShip(Position::DIRECTION_WEST, $amount),
            'S' => $this->moveShip(Position::DIRECTION_SOUTH, $amount),
            'R' => $this->direction += $amount,
            'L' => $this->direction -= $amount,
        };

        return $this;
    }

    protected function moveShip(int $direction, int $amount): void
    {
        match ($direction % 360) {
            self::DIRECTION_NORTH => $this->north += $amount,
            self::DIRECTION_EAST => $this->east += $amount,
            self::DIRECTION_SOUTH => $this->north -= $amount,
            self::DIRECTION_WEST => $this->east -= $amount,
        };
    }
}
