<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\Solver;

class SolveConfiguration
{
    final public const TEST_FILE = 'test.txt';

    final public const REAL_FILE = 'input.txt';

    protected string $file = self::REAL_FILE;

    protected array $parts = [Solver::PART_ONE, Solver::PART_TWO];

    public function __construct(
        public readonly int $year,
        public readonly int $day,
    ) {
    }

    public function solveOnlyPartOne(): void
    {
        $this->parts = [Solver::PART_ONE];
    }

    public function solveOnlyPartTwo(): void
    {
        $this->parts = [Solver::PART_TWO];
    }

    public function solveBothParts(): void
    {
        $this->parts = [Solver::PART_ONE, Solver::PART_TWO];
    }

    public function useTestInput(): void
    {
        $this->file = self::TEST_FILE;
    }

    public function useRealInput(): void
    {
        $this->file = self::REAL_FILE;
    }

    public static function parse(null|string|int $year, null|int|string $day): static
    {
        $parsedYear = ! empty($year) ? (int) $year : now()->year;
        $parsedDay = ! empty($day) ? (int) $day : now()->day;
        return new static($parsedYear, $parsedDay);
    }

    public function parts(): iterable
    {
        yield from $this->parts;
    }
}
