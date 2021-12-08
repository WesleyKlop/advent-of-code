<?php

namespace App\Solvers\Y2021\Day8;

class SegmentDisplayDecoder
{
    /**
     * Corresponds to how many segments a digit has.
     */
    private const NUMBER_SEGMENT_MAP = [
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

    private function __construct(public array $mapping)
    {
    }

    public static function make(): static
    {
        return new static ([
            'abcdefg' => 8,
        ]);
    }

    public function isDecoded(int $val): bool
    {
        return collect($this->mapping)
            ->filter()
            ->flip()
            ->has($val);
    }

    private function normalizeDigit(string $digit): string
    {
        $exploded = str_split($digit);
        sort($exploded);
        return implode('', $exploded);
    }

    public function decode(string $digit): ?int
    {
        $normalized = $this->normalizeDigit($digit);
        if (array_key_exists($normalized, $this->mapping)) {
            return $this->mapping[$normalized];
        }

        $reverseArrayMapping = collect($this->mapping)
            ->filter()
            ->flip()
            ->map(fn($str) => str_split($str));

        if (strlen($digit) === 5) {
            if (count(array_intersect($reverseArrayMapping->get(7), str_split($normalized))) === 3) {
                // If we intersect with 7 and get a length of 3, the number is 3
                $this->mapping[$normalized] = 3;
            } elseif (count(array_intersect($reverseArrayMapping->get(4), str_split($normalized))) === 3) {
                // If we intersect with 4 and get a length of 3, the number is 5
                $this->mapping[$normalized] = 5;
            } else {
                // Otherwise it's a 2
                $this->mapping[$normalized] = 2;
            }
        }

        if (strlen($digit) === 6) {
            if (count(array_intersect($reverseArrayMapping->get(4), str_split($normalized))) === 4) {
                // If we intersect with 4 and get a length of 4, the number is 9
                $this->mapping[$normalized] = 9;
            } elseif (count(array_intersect($reverseArrayMapping->get(7), str_split($normalized))) === 3) {
                // If we intersect with 7 and get a length of 3, the number is 0
                $this->mapping[$normalized] = 0;
            } else {
                // Otherwise it's a 6
                $this->mapping[$normalized] = 6;
            }
        }

        return $this->mapping[$normalized];
    }

    public function decodeWanted(array $input): void
    {
        foreach ($input as $wanted) {
            switch (strlen($wanted)) {
                case 2:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->mapping[$normalized] = 1;
                    break;
                case 3:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->mapping[$normalized] = 7;
                    break;
                case 4:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->mapping[$normalized] = 4;
                    break;
                case 7:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->mapping[$normalized] = 8;
                    break;
            }
        }
    }
}
