<?php


namespace App\Solvers;


use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait UsesInput
{
    protected function read(string $year, string $day, string $name = 'input.txt'): Stringable
    {
        $path = resource_path(sprintf("inputs/%s/%s/%s", $year, $day, $name));
        $contents = file_get_contents($path);

        return Str::of($contents)->trim();
    }
}
