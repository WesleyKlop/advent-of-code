<?php


namespace App\Solvers\Y2020\Day12;

class Position
{
    private int $north;
    private int $east;
    private int $direction;

    public const DIRECTION_EAST = 90;
    public const DIRECTION_SOUTH = 180;
    public const DIRECTION_WEST = 270;
    public const DIRECTION_NORTH = 0;

    public function __construct()
    {
        $this->north = 0;
        $this->east = 0;
        $this->direction = self::DIRECTION_EAST;
    }

    public function manhattanDistance(): int
    {
        return abs($this->east) + abs($this->north);
    }

    public function process(string $instruction): self
    {
        $move = $instruction[0];
        $amount = substr($instruction, 1);

        switch ($move) {
            case 'F':
                $this->move($this->direction, $amount);
                break;
            case 'N':
                $this->move(self::DIRECTION_NORTH, $amount);
                break;
            case 'E':
                $this->move(self::DIRECTION_EAST, $amount);
                break;
            case 'W':
                $this->move(self::DIRECTION_WEST, $amount);
                break;
            case 'S':
                $this->move(self::DIRECTION_SOUTH, $amount);
                break;
            case 'R':
                $this->direction += $amount;
                break;
            case 'L':
                $this->direction -= $amount;
                break;
        }
        return $this;
    }

    private function move(int $direction, int $amount): void
    {
        switch ($direction % 360) {
            case self::DIRECTION_NORTH:
                $this->north += $amount;
                break;
            case self::DIRECTION_EAST:
                $this->east += $amount;
                break;
            case self::DIRECTION_SOUTH:
                $this->north -= $amount;
                break;
            case self::DIRECTION_WEST:
                $this->east -= $amount;
        }
    }
}
