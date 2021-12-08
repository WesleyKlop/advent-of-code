<?php

namespace App\Solvers\Y2021\Day8;

class SegmentDisplayDecoder
{
    /**
     * Corresponds to how many segments a digit has.
     */
    private const NUMBER_MAP = [
        0 => 6,
        1 => 2,
        2 => 5,
        3 => 5,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 3,
        8 => 7,
        9 => 6,
    ];

    private function __construct(
        private array $possibilities,
        private array $solved
    ) {
    }

    public static function make(): static
    {
        $numbers = range(0, 9);
        $possibilities = array_map(function () {
            return range('a', 'g');
        }, $numbers);
        $solved = array_map(function () {
            return null;
        }, $numbers);
        return new static ($possibilities, $solved);
    }

    public function fitSegment(string $digit): ?int
    {
        $segments = strlen($digit);
        $possibilities = array_filter(
            self::NUMBER_MAP,
            fn(int $value) => $value === $segments
        );
        if (count($possibilities) !== 1) {
            return null;
        }
        foreach ($possibilities as $number => $segments) {
            $this->possibilities[$number] = str_split($digit);
            sort($this->possibilities[$number]);
            $this->solved[$number] = $digit;
        }
        return array_key_first($possibilities);
    }

    public function solved(): array
    {
        return $this->solved;
    }

    public function isSolved(int ...$numbers): bool
    {
        foreach ($numbers as $number) {
            if ($this->solved[$number] === null) {
                return false;
            }
        }
        return true;
    }
}
