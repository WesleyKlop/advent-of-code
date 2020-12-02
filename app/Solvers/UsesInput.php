<?php


namespace App\Solvers;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait UsesInput
{
    protected function read(?string $year = null, ?string $day = null, string $name = 'input.txt'): Stringable
    {
        if($year === null || $day === null) {
            preg_match("/Y(\d+)\\\Day(\d+)\\\/", static::class, $matches);
            [, $year, $day] = $matches;
        }
        $path = resource_path(sprintf("inputs/%s/%s/%s", $year, $day, $name));
        $contents = file_get_contents($path);

        return Str::of($contents)->trim();
    }
}
