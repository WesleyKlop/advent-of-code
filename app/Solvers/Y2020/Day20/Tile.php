<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day20;

class Tile
{
    public function __construct(
        private int $id,
        private array $grid
    ) {
    }

    public static function fromString(string $tile): static
    {
        $tile = explode("\n", $tile);
        [, $tileId] = explode(' ', substr($tile[0], 0, -1));
        unset($tile[0]);
        $grid = array_map(fn (string $line) => str_split($line), $tile);
        return new static((int) $tileId, $grid);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function rotateRight(): static
    {
        return new static($this->id, array_map(null, ...array_reverse($this->grid)));
    }

    public function rotateLeft(): static
    {
        return new static($this->id, array_reverse(array_map(null, ...$this->grid)));
    }

    public function print(): string
    {
        return implode("\n", array_map(fn (array $line) => implode(', ', $line), $this->grid));
    }

    public function flipHorizontal(): static
    {
        return new static($this->id, array_reverse($this->grid));
    }

    public function flipVertical(): static
    {
        return new static($this->id, array_map(fn (array $line) => array_reverse($line), $this->grid));
    }

    /**
     * @return iterable<static>
     */
    public function possibilities(): iterable
    {
        yield $this;
        yield $this->flipVertical();
        yield $this->flipHorizontal();
        $rotatedOnce = $this->rotateLeft();
        yield $rotatedOnce;
        $rotatedTwice = $rotatedOnce->rotateLeft();
        yield $rotatedTwice;
        yield $rotatedTwice->rotateLeft();
    }
}
