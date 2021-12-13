<?php

declare(strict_types=1);

namespace App\Common;

class Grid
{
    public static function expand(array $grid, string $fill = '.'): array
    {
        $width = range(0, max(array_map('array_key_last', $grid)));
        $height = range(0, max(array_keys($grid)));
        foreach ($height as $y) {
            foreach ($width as $x) {
                $grid[$y][$x] ??= $fill;
            }
            ksort($grid[$y]);
        }
        ksort($grid);

        return $grid;
    }

    public static function dump(array $grid): void
    {
        foreach ($grid as $row) {
            foreach ($row as $cell) {
                echo $cell;
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    public static function countBy(array $folded, string $string): int
    {
        $count = 0;
        foreach ($folded as $row) {
            foreach ($row as $cell) {
                if ($cell === $string) {
                    $count++;
                }
            }
        }

        return $count;
    }
}
