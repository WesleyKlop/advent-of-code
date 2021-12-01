<?php

declare(strict_types=1);

namespace App\Solvers\Y2020\Day2;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    protected function solvePartOne(): Solution
    {
        $input = $this->getInput();

        $validPasswords = $input->filter(function ($row) {
            $count = mb_substr_count($row['password'], $row['letter']);
            return $count <= $row['max'] && $count >= $row['min'];
        });

        return new PrimitiveValueSolution($validPasswords->count());
    }

    protected function solvePartTwo(): Solution
    {
        $input = $this->getInput();

        $validPasswords = $input->filter(fn($row) => $row['password'][$row['min'] - 1] === $row['letter'] xor $row['password'][$row['max'] - 1] === $row['letter']);

        return new PrimitiveValueSolution($validPasswords->count());
    }

    private function getInput(): Collection
    {
        return $this->read('2020', '2')
            ->explode("\n")
            ->map(function ($line) {
                preg_match("/^(\d+)-(\d+) (\w): (\w+)$/", $line, $matches);
                [,$min, $max, $letter, $password] = $matches;

                return [
                    'min' => $min,
                    'max' => $max,
                    'letter' => $letter,
                    'password' => $password,
                ];
            });
    }
}
