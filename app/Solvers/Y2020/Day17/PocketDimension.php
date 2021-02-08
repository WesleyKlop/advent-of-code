<?php

declare(strict_types=1);


namespace App\Solvers\Y2020\Day17;

use Illuminate\Support\Stringable;

class PocketDimension
{
    /**
     * PocketDimension constructor.
     * @param Cube[][][] $region
     */
    public function __construct(private array $region)
    {
    }

    public static function fromStringable(Stringable $input): static
    {
        $region = [];
        foreach ($input->explode("\n") as $x => $line) {
            foreach (str_split($line) as $y => $state) {
                $region[$x][$y][0] = new Cube($state, $x, $y, z: 0);
            }
        }
        return new PocketDimension($region);
    }

    private function getCube(int $x, int $y, int $z): Cube
    {
        return $this->region[$x][$y][$z] ??= new Cube(x: $x, y: $y, z: $z);
    }

    public function cycle(): static
    {
        $flipList = [];
        $allCubesConsidered = $this->getAllNeighbours();

        foreach ($allCubesConsidered as $cube) {
            $neighbours = $this->getNeighbours($cube, Cube::STATE_ACTIVE);
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
    public function getNeighbours(Cube $cube, string $state = null): iterable
    {
        foreach ($this->getMatrix() as $delta) {
            $other = $this->getRelativeToCube($cube, ...$delta);
            if ($state !== null && $other->getState() !== $state) {
                continue;
            }
            yield $other;
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

    private function getRelativeToCube(Cube $cube, int $dx, int $dy, int $dz): Cube
    {
        return $this->getCube(
            $cube->x + $dx,
            $cube->y + $dy,
            $cube->z + $dz,
        );
    }

    public function printLayer(int $z): void
    {
        echo 'z=' . $z . PHP_EOL;
        foreach ($this->region as $x => $layer) {
            foreach ($layer as $y => $line) {
                echo $this->getCube($x, $y, $z)->isActive() ? '#' : '.';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    private function getAllNeighbours(): array
    {
        /** @var Cube[] $allCubes */
        $allCubes = [];
        foreach ($this->region as $x => $grid) {
            foreach ($grid as $y => $line) {
                foreach ($line as $z => $resolvedCube) {
                    $neighbours = $this->getNeighbours($resolvedCube);
                    $allCubes[$resolvedCube->getKey()] = $resolvedCube;
                    foreach ($neighbours as $neighbour) {
                        $allCubes[$neighbour->getKey()] = $neighbour;
                    }
                }
            }
        }
        return array_values($allCubes);
    }

    public function countActiveCubes(): int
    {
        $count = 0;
        foreach ($this->region as $x => $grid) {
            foreach ($grid as $y => $line) {
                foreach ($line as $z => $resolvedCube) {
                    if ($resolvedCube->isActive()) {
                        $count += 1;
                    }
                }
            }
        }

        return $count;
    }
}
