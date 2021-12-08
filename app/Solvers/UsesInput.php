<?php

declare(strict_types=1);

namespace App\Solvers;

use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait UsesInput
{
    protected string $fileName = 'input.txt';

    protected function read(string $year, string $day): Stringable
    {
        $path = $this->getPath($year, $day, $this->fileName);

        return Str::of(file_get_contents($path))->trim();
    }

    protected function readLazy(string $year, string $day): LazyCollection
    {
        $path = $this->getPath($year, $day, $this->fileName);

        return LazyCollection::make(function () use ($path) {
            $handle = null;
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
        return resource_path(sprintf('inputs/%s/%s/%s', $year, $day, $name));
    }
}
