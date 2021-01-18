<?php


namespace App\Solvers\Y2020\Day12;

class WaypointShipPosition implements Position
{
    protected float $waypointDeltaNorth = 1;
    protected float $waypointDeltaEast = 10;
    protected int $shipNorth = 0;
    protected int $shipEast = 0;
    protected int $rotation = Position::DIRECTION_EAST;

    public function process(string $instruction): self
    {
        $move = $instruction[0];
        $amount = (int) substr($instruction, 1);

        switch ($move) {
            case 'F':
                $this->moveShipTowardsWayPoint($amount);
                break;
            case 'N':
                $this->moveWaypoint(Position::DIRECTION_NORTH, $amount);
                break;
            case 'E':
                $this->moveWaypoint(Position::DIRECTION_EAST, $amount);
                break;
            case 'W':
                $this->moveWaypoint(Position::DIRECTION_WEST, $amount);
                break;
            case 'S':
                $this->moveWaypoint(Position::DIRECTION_SOUTH, $amount);
                break;
            case 'R':
                $this->rotateWaypoint($amount);
                break;
            case 'L':
                $this->rotateWaypoint(-$amount);
                break;
        }

        return $this;
    }

    public function manhattanDistance(): int
    {
        return abs($this->shipNorth) + abs($this->shipEast);
    }

    private function moveShipTowardsWayPoint(int $amount)
    {
        $this->shipEast += $this->waypointDeltaEast * $amount;
        $this->shipNorth += $this->waypointDeltaNorth * $amount;
    }

    protected function moveWaypoint(int $direction, int $amount): void
    {
        switch ($direction % 360) {
            case self::DIRECTION_NORTH:
                $this->waypointDeltaNorth += $amount;
                break;
            case self::DIRECTION_EAST:
                $this->waypointDeltaEast += $amount;
                break;
            case self::DIRECTION_SOUTH:
                $this->waypointDeltaNorth -= $amount;
                break;
            case self::DIRECTION_WEST:
                $this->waypointDeltaEast -= $amount;
        }
    }

    private function rotateWaypoint(int $amount): void
    {
        $radians = deg2rad(-$amount);

        $dx = $this->waypointDeltaEast;
        $dy = $this->waypointDeltaNorth;

        $this->waypointDeltaEast = round(($dx * cos($radians)) - ($dy * sin($radians)));
        $this->waypointDeltaNorth = round(($dx * sin($radians)) + ($dy * cos($radians)));
    }
}
