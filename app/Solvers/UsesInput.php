<?php


namespace App\Solvers;

<<<<<<< HEAD
use Illuminate\Support\LazyCollection;
=======
use App\Contracts\FromLine;
use App\Exceptions\ApplicationException;
use Illuminate\Support\Collection;
>>>>>>> 7f18d3e (Day 3 solution)
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

trait UsesInput
{
    protected function read(string $year, string $day, string $name = 'input.txt'): Stringable
    {
<<<<<<< HEAD
        if ($year === null || $day === null) {
            preg_match("/Y(\d+)\\\Day(\d+)\\\/", static::class, $matches);
            [, $year, $day] = $matches;
        }
        $path = $this->getPath($year, $day, $name);
=======
        $path = resource_path(sprintf("inputs/%s/%s/%s", $year, $day, $name));
        $contents = file_get_contents($path);
>>>>>>> 7f18d3e (Day 3 solution)

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

    /**
     * @param class-string<FromLine> $into
     * @param string $year
     * @param string $day
     * @param string $name
     * @return Collection
     */
    protected function readInto(string $into, string $year, string $day, string $name = 'input.txt'): Collection {
        if(!array_key_exists(FromLine::class ,class_implements($into)) || ! class_exists($into)) {
            throw new ApplicationException($into . " must implement FromLine interface");
        }
        return $this
            ->read($year, $day, $name)
            ->explode("\n")
            ->map(fn($line) => $into::fromLine($line));
    }
}
