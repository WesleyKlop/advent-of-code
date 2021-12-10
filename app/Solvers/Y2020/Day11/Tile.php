<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day11;

class Tile
{
    final public const TYPE_FLOOR = '.';

    final public const TYPE_EMPTY = 'L';

    final public const TYPE_OCCUPIED = '#';

    public function __construct(
        private readonly string $type
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function flip(): self
    {
        return match ($this->type) {
            self::TYPE_OCCUPIED => new static(self::TYPE_EMPTY),
            self::TYPE_EMPTY => new static(self::TYPE_OCCUPIED),
            default => $this,
        };
    }

    public function isOccupied(): bool
    {
        return $this->type === static::TYPE_OCCUPIED;
    }

    public function equals(self $tile): bool
    {
        return $this->type === $tile->type;
    }

    public function isEmpty(): bool
    {
        return $this->type === static::TYPE_EMPTY;
    }

    public function isFloor(): bool
    {
        return $this->type === static::TYPE_FLOOR;
    }
}
