<?php


namespace App\Solvers;

use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait UsesInput
{
    protected function read(string $year, string $day, string $name = 'input.txt'): Stringable
    {
        $path = $this->getPath($year, $day, $name);

        return Str::of(file_get_contents($path))->trim();
    }

    protected function readLazy(string $year, string $day, string $name = 'input.txt'): LazyCollection
    {
        $path = $this->getPath($year, $day, $name);

        return LazyCollection::make(function () use ($path) {
            try {
                $handle = fopen($path, 'rb');

                while (($line = fgets($handle)) !== false) {
                    yield trim($line);
                }
            } finally {
                fclose($handle);
            }
        });
    }

    private function getPath(string $year, string $day, string $name): string
    {
        return resource_path(sprintf("inputs/%s/%s/%s", $year, $day, $name));
    }
}
