<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day8;

class SegmentDisplayDecoder
{
    private function __construct(
        private array $segmentsToNumber,
        private array $numberToSegments
    ) {
    }

    public static function make(): static
    {
        $mapping = [
            'abcdefg' => 8,
        ];
        return new static (
            $mapping,
            array_flip($mapping)
        );
    }

    public function addMapping(int $number, string $segments): void
    {
        $this->segmentsToNumber[$segments] = $number;
        $this->numberToSegments[$number] = $segments;
    }

    public function hasMapping(int|string $value): bool
    {
        if (is_int($value)) {
            return array_key_exists($value, $this->numberToSegments);
        }
        return array_key_exists($value, $this->segmentsToNumber);
    }

    public function decode(string $digit): ?int
    {
        $normalized = $this->normalizeDigit($digit);
        if ($this->hasMapping($normalized)) {
            return $this->segmentsToNumber[$normalized];
        }

        $exploded = str_split($normalized);

        if (strlen($digit) === 5) {
            if ($this->countIntersection(7, $exploded) === 3) {
                // If we intersect with 7 and get a length of 3, the number is 3
                $this->addMapping(3, $normalized);
            } elseif ($this->countIntersection(4, $exploded) === 3) {
                // If we intersect with 4 and get a length of 3, the number is 5
                $this->addMapping(5, $normalized);
            } else {
                // Otherwise it's a 2
                $this->addMapping(2, $normalized);
            }
        }

        if (strlen($digit) === 6) {
            if ($this->countIntersection(4, $exploded) === 4) {
                // If we intersect with 4 and get a length of 4, the number is 9
                $this->addMapping(9, $normalized);
            } elseif ($this->countIntersection(7, $exploded) === 3) {
                // If we intersect with 7 and get a length of 3, the number is 0
                $this->addMapping(0, $normalized);
            } else {
                // Otherwise it's a 6
                $this->addMapping(6, $normalized);
            }
        }

        return $this->segmentsToNumber[$normalized];
    }

    public function decodeWanted(array $input): void
    {
        foreach ($input as $wanted) {
            switch (strlen($wanted)) {
                case 2:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->addMapping(1, $normalized);
                    break;
                case 3:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->addMapping(7, $normalized);
                    break;
                case 4:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->addMapping(4, $normalized);
                    break;
                case 7:
                    $normalized = $this->normalizeDigit($wanted);
                    $this->segmentsToNumber[$normalized] = 8;
                    break;
            }
        }
    }

    public function countIntersection(int $key, array $exploded): int
    {
        return count(array_intersect(
            str_split($this->numberToSegments[$key]),
            $exploded,
        ));
    }

    private function normalizeDigit(string $digit): string
    {
        $exploded = str_split($digit);
        sort($exploded);
        return implode('', $exploded);
    }
}
