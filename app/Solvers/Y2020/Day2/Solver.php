<?php


namespace App\Solvers\Y2020\Day2;

use App\Contracts\Solution;
use App\Solutions\PrimitiveValueSolution;
use App\Solvers\AbstractSolver;
use App\Solvers\UsesInput;
use Illuminate\Support\Collection;

class Solver extends AbstractSolver
{
    use UsesInput;

    private function getInput(): Collection
    {
        return $this->read('2020', '2')
            ->explode("\n")
            ->map(function ($line) {
                preg_match("/^(\d+)-(\d+)\ ([a-z]): ([a-z]+)$/", $line, $matches);
                [,$min, $max, $letter, $password] = $matches;

                return [
                    'min' => $min,
                    'max' => $max,
                    'letter' => $letter,
                    'password' => $password,
                ];
            });
    }

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

        $validPasswords = $input->filter(function ($row) {
            $isValid = $row['password'][$row['min'] - 1] === $row['letter'];
            return $isValid
                ? $row['password'][$row['max'] - 1] !== $row['letter']
                : $row['password'][$row['max'] - 1] === $row['letter'];
        });

        return new PrimitiveValueSolution($validPasswords->count());
    }
}
