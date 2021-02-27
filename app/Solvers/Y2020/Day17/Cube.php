<?php


namespace App\Solvers\Y2020\Day17;

class Cube
{
    public function getState(): string
    {
        return $this->state;
    }
    public const STATE_ACTIVE = '#';
    public const STATE_INACTIVE = '.';

    public function __construct(
        private string $state = self::STATE_INACTIVE,
        public int $x = 0,
        public int $y = 0,
        public int $z = 0,
        public int $w = 0,
    ) {
    }

    public function isActive(): bool
    {
        return $this->state === static::STATE_ACTIVE;
    }

    public function flip(): self
    {
        $this->state = $this->isActive()
            ? static::STATE_INACTIVE
            : static::STATE_ACTIVE;

        return $this;
    }

    public function shouldFlip(iterable $neighbours): bool
    {
        return ($this->isActive() && !in_array(iterator_count($neighbours), [2, 3]))
            || (!$this->isActive() && iterator_count($neighbours) === 3);
    }
}
