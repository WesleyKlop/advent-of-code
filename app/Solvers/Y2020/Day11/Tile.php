<?php


namespace App\Solvers\Y2020\Day11;


class Tile
{
    public const TYPE_FLOOR = '.';
    public const TYPE_EMPTY = 'L';
    public const TYPE_OCCUPIED = '#';

    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function flip(): void
    {
        switch ($this->type) {
            case self::TYPE_OCCUPIED:
                $this->type = self::TYPE_EMPTY;
                return;
            case self::TYPE_EMPTY:
                $this->type = self::TYPE_OCCUPIED;
                return;
        }
    }


}
