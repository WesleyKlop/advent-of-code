<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day17;

use Illuminate\Support\Stringable;

class PocketDimension
{
    /**
     * PocketDimension constructor.
     * @param Cube[] $region
     */
    public function __construct(private array $region)
    {
    }

    public static function fromStringable(Stringable $input): static
    {
        $region = [];
        foreach ($input->explode("\n") as $x => $line) {
            foreach (str_split($line) as $y => $state) {
                $region[self::getKey($x, $y, 0)] = new Cube($state, $x, $y, z: 0);
            }
        }
        return new PocketDimension($region);
    }

    private static function getKey(int $x, int $y, int $z): string
    {
        return sprintf("x%dy%dz%d", $x, $y, $z);
    }

    private function getCube(bool $create, int $x, int $y, int $z): ?array
    {
        $key = self::getKey($x, $y, $z);
        if (!$create && !isset($this->region[$key])) {
            return null;
        }
        return [$key, $this->region[$key] ??= new Cube(x: $x, y: $y, z: $z)];
    }

    public function cycle(): static
    {
        $flipList = [];
        $allCubesConsidered = $this->getAllNeighbours();

        foreach ($allCubesConsidered as $cube) {
            $neighbours = $this->getNeighbours($cube);
            if ($cube->shouldFlip($neighbours)) {
                $flipList[] = $cube;
            }
        }

        foreach ($flipList as $cube) {
            $cube->flip();
        }

        return new static($this->region);
    }

    /**
     * @param Cube $cube
     * @param string|null $state
     * @return iterable<Cube>
     */
    public function getNeighbours(Cube $cube, string $state = null, bool $create = true): iterable
    {
        foreach ($this->getMatrix() as $delta) {
            $result = $this->getRelativeToCube($cube, $create, ...$delta);
            if ($result === null || ($state !== null && $result[1]->getState() !== $state)) {
                continue;
            }
            yield $result[0] => $result[1];
        }
    }

    private function getMatrix(): array
    {
        return [
            [-1, -1, -1],
            [-1, -1, 0],
            [-1, -1, 1],
            [-1, 0, -1],
            [-1, 0, 0],
            [-1, 0, 1],
            [-1, 1, -1],
            [-1, 1, 0],
            [-1, 1, 1],
            [0, -1, -1],
            [0, -1, 0],
            [0, -1, 1],
            [0, 0, -1],
            // [0, 0, 0],
            [0, 0, 1],
            [0, 1, -1],
            [0, 1, 0],
            [0, 1, 1],
            [1, -1, -1],
            [1, -1, 0],
            [1, -1, 1],
            [1, 0, -1],
            [1, 0, 0],
            [1, 0, 1],
            [1, 1, -1],
            [1, 1, 0],
            [1, 1, 1],
        ];
    }

    private function getRelativeToCube(Cube $cube, bool $create, int $dx, int $dy, int $dz): ?array
    {
        return $this->getCube(
            $create,
            $cube->x + $dx,
            $cube->y + $dy,
            $cube->z + $dz,
        );
    }

    private function getAllNeighbours(): iterable
    {
        $seenCubes = [];
        foreach ($this->region as $key => $resolvedCube) {
            $neighbours = $this->getNeighbours($resolvedCube, create: false);
            foreach ($neighbours as $nKey => $neighbour) {
                if (!isset($seenCubes[$nKey])) {
                    $seenCubes[$nKey] = null;
                    yield $nKey => $neighbour;
                }
            }
        }
    }

    public function countActiveCubes(): int
    {
        $count = 0;
        foreach ($this->region as $cube) {
            if ($cube->isActive()) {
                $count += 1;
            }
        }

        return $count;
    }
}
