<?php

declare(strict_types=1);

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

        match ($move) {
            'F' => $this->moveShipTowardsWayPoint($amount),
            'N' => $this->moveWaypoint(Position::DIRECTION_NORTH, $amount),
            'E' => $this->moveWaypoint(Position::DIRECTION_EAST, $amount),
            'W' => $this->moveWaypoint(Position::DIRECTION_WEST, $amount),
            'S' => $this->moveWaypoint(Position::DIRECTION_SOUTH, $amount),
            'R' => $this->rotateWaypoint($amount),
            'L' => $this->rotateWaypoint(-$amount),
        };

        return $this;
    }

    public function manhattanDistance(): int
    {
        return abs($this->shipNorth) + abs($this->shipEast);
    }

    protected function moveWaypoint(int $direction, int $amount): void
    {
        match ($direction % 360) {
            self::DIRECTION_NORTH => $this->waypointDeltaNorth += $amount,
            self::DIRECTION_EAST => $this->waypointDeltaEast += $amount,
            self::DIRECTION_SOUTH => $this->waypointDeltaNorth -= $amount,
            self::DIRECTION_WEST => $this->waypointDeltaEast -= $amount,
        };
    }

    private function moveShipTowardsWayPoint(int $amount)
    {
        $this->shipEast += $this->waypointDeltaEast * $amount;
        $this->shipNorth += $this->waypointDeltaNorth * $amount;
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
