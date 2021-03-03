<?php


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
        return new Tile($tileId, $grid);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function rotateRight(): void
    {
        $this->grid = array_map(null, ...array_reverse($this->grid));
    }

    public function rotateLeft(): void {
        $this->grid = array_reverse(array_map(null, ...$this->grid));
    }

    public function print(): string
    {
        return implode("\n", array_map(fn(array $line) => implode(', ', $line), $this->grid));
    }

    public function flipHorizontal(): void {
        $this->grid = array_reverse($this->grid);
    }

    public function flipVertical(): void {
        $this->grid = array_map(fn(array $line) => array_reverse($line), $this->grid);
    }
}
