<?php


namespace App\Solvers\Y2020\Day12;

 class ShipPosition implements Position
{
    protected int $north;
    protected int $east;
    protected int $direction;

    public function __construct(int $north = 0, int $east = 0, int $direction = Position::DIRECTION_EAST)
    {
        $this->north = $north;
        $this->east = $east;
        $this->direction = $direction;
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
                 $this->moveShip($this->direction, $amount);
                 break;
             case 'N':
                 $this->moveShip(Position::DIRECTION_NORTH, $amount);
                 break;
             case 'E':
                 $this->moveShip(Position::DIRECTION_EAST, $amount);
                 break;
             case 'W':
                 $this->moveShip(Position::DIRECTION_WEST, $amount);
                 break;
             case 'S':
                 $this->moveShip(Position::DIRECTION_SOUTH, $amount);
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

    protected function moveShip(int $direction, int $amount): void
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
