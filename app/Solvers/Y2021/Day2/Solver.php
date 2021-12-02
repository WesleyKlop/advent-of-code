<?php

declare(strict_types=1);


namespace App\Solvers\Y2021\Day2;

use App\Contracts\Solution;
use App\Exceptions\ApplicationException;
use App\Solutions\PrimitiveValueSolution;
use App\Solutions\TodoSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\LazyCollection;

class Solver extends AbstractSolver
{
    protected string $fileName = 'input.txt';

    private function getInput(): LazyCollection
    {
        return $this->readLazy('2021', '2');
    }

    protected function solvePartOne(): Solution
    {
        // x, y
        $position = [0, 0];

        $this->getInput()
            ->each(function (string $instruction) use (&$position) {
                [$direction, $amount] = explode(' ', $instruction);
                switch ($direction) {
                    case 'forward':
                        $position[0] += (int)$amount;
                        break;
                    case 'up':
                        $position[1] -= (int)$amount;
                        break;
                    case 'down':
                        $position[1] += (int)$amount;
                        break;
                    default:
                        throw new ApplicationException('Unknown instruction: ' . $instruction);
                }
            })
            ->collect();
        return new PrimitiveValueSolution(array_product($position));
    }

    protected function solvePartTwo(): Solution
    {
        return new TodoSolution();
    }
}
