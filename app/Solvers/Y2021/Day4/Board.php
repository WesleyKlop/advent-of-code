<?php

declare(strict_types=1);

namespace App\Solvers\Y2021\Day4;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Board
{
    private Collection $content;

    private array $markedRows = [0, 0, 0, 0, 0];

    private array $markedCols = [0, 0, 0, 0, 0];

    private int $sub = 0;

    public function __construct(string $raw, private int $id)
    {
        $this->content = Str::of($raw)
            ->trim()
            ->explode("\n")
            ->transform(
                fn(string $line) => Str::of($line)
                    ->trim()
                    ->split('/ +/')
                    ->transform(fn(string $int) => (int)$int)
            );
    }

    public function sum(): int
    {
        $sum = -$this->sub;
        foreach ($this->content as $row) {
            foreach ($row as $col) {
                $sum += $col;
            }
        }
        return $sum;
    }

    public function mark(int $number): bool
    {
        foreach ($this->content as $rowIdx => $row) {
            foreach ($row as $colIdx => $column) {
                if ($column === $number) {
                    $this->markedRows[$rowIdx]++;
                    $this->markedCols[$colIdx]++;
                    $this->sub += $column;
                    if ($this->markedCols[$colIdx] === 5 || $this->markedRows[$rowIdx] === 5) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function is(self $other): bool
    {
        return $this->id === $other->id;
    }
}
